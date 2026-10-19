<?php

namespace App\Support;

class TiptapRenderer
{
    /**
     * Turn TipTap document JSON, or a plain string, into HTML.
     */
    public function render(mixed $content): string
    {
        if (is_string($content)) {
            $decoded = json_decode($content, true);

            if (json_last_error() === JSON_ERROR_NONE && $decoded !== $content) {
                return $this->render($decoded);
            }

            return $this->plainText($content);
        }

        if (! is_array($content)) {
            return '';
        }

        if (($content['type'] ?? null) !== 'doc') {
            return '';
        }

        return $this->nodes($content['content'] ?? []);
    }

    /**
     * @param  array<int, mixed>  $nodes
     */
    private function nodes(array $nodes): string
    {
        $html = '';

        foreach ($nodes as $node) {
            if (is_array($node)) {
                $html .= $this->node($node);
            }
        }

        return $html;
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function node(array $node): string
    {
        $type = $node['type'] ?? '';

        if ($type === 'text') {
            return $this->text($node);
        }

        if ($type === 'hardBreak') {
            return '<br>';
        }

        if ($type === 'horizontalRule') {
            return '<hr>';
        }

        $children = $this->nodes($node['content'] ?? []);

        return match ($type) {
            'paragraph' => $this->block('p', $node, $children === '' ? '<br>' : $children),
            'heading' => $this->heading($node, $children),
            'bulletList' => '<ul>'.$children.'</ul>',
            'orderedList' => '<ol>'.$children.'</ol>',
            'listItem' => '<li>'.$children.'</li>',
            'taskList' => '<ul data-type="taskList">'.$children.'</ul>',
            'taskItem' => $this->taskItem($node, $children),
            'blockquote' => '<blockquote>'.$children.'</blockquote>',
            'codeBlock' => $this->codeBlock($node, $children),
            'image' => $this->image($node),
            'table' => '<table><tbody>'.$children.'</tbody></table>',
            'tableRow' => '<tr>'.$children.'</tr>',
            'tableHeader' => $this->cell('th', $node, $children),
            'tableCell' => $this->cell('td', $node, $children),
            default => $children,
        };
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function heading(array $node, string $children): string
    {
        $level = (int) ($node['attrs']['level'] ?? 2);
        $level = min(6, max(1, $level));

        return '<h'.$level.$this->align($node).'>'.$children.'</h'.$level.'>';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function block(string $tag, array $node, string $children): string
    {
        return '<'.$tag.$this->align($node).'>'.$children.'</'.$tag.'>';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function align(array $node): string
    {
        $align = $node['attrs']['textAlign'] ?? null;

        if (! in_array($align, ['left', 'center', 'right', 'justify'], true)) {
            return '';
        }

        return ' style="text-align: '.$align.'"';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function taskItem(array $node, string $children): string
    {
        $checked = ($node['attrs']['checked'] ?? false) === true;

        return '<li data-type="taskItem" data-checked="'.($checked ? 'true' : 'false').'">'
            .'<label><input type="checkbox" disabled'.($checked ? ' checked' : '').'></label>'
            .'<div>'.$children.'</div></li>';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function codeBlock(array $node, string $children): string
    {
        $language = $node['attrs']['language'] ?? null;
        $class = is_string($language) && preg_match('/^[a-z0-9+-]+$/i', $language) === 1
            ? ' class="language-'.e($language).'"'
            : '';

        return '<pre><code'.$class.'>'.$children.'</code></pre>';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function image(array $node): string
    {
        $src = $node['attrs']['src'] ?? '';

        if (! is_string($src) || preg_match('#^(https?://|/storage/)#i', $src) !== 1) {
            return '';
        }

        $alt = e(is_string($node['attrs']['alt'] ?? null) ? $node['attrs']['alt'] : '');
        $style = $this->imageSize($node);

        return '<img src="'.e($src).'" alt="'.$alt.'"'.$style.'>';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function imageSize(array $node): string
    {
        $parts = [];

        foreach (['width', 'height'] as $side) {
            $value = $node['attrs'][$side] ?? null;

            if (is_numeric($value) && (int) $value > 0) {
                $parts[] = $side.': '.(int) $value.'px';
            }
        }

        if ($parts === []) {
            return '';
        }

        return ' style="'.implode('; ', $parts).'"';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function cell(string $tag, array $node, string $children): string
    {
        $attrs = '';

        foreach (['colspan', 'rowspan'] as $name) {
            $value = $node['attrs'][$name] ?? null;

            if (is_numeric($value) && (int) $value > 1) {
                $attrs .= ' '.$name.'="'.(int) $value.'"';
            }
        }

        return '<'.$tag.$attrs.'>'.$children.'</'.$tag.'>';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function text(array $node): string
    {
        $text = e($node['text'] ?? '');

        foreach (array_reverse($node['marks'] ?? []) as $mark) {
            if (! is_array($mark)) {
                continue;
            }

            $text = match ($mark['type'] ?? '') {
                'bold' => '<strong>'.$text.'</strong>',
                'italic' => '<em>'.$text.'</em>',
                'strike' => '<s>'.$text.'</s>',
                'underline' => '<u>'.$text.'</u>',
                'code' => '<code>'.$text.'</code>',
                'highlight' => '<mark>'.$text.'</mark>',
                'subscript' => '<sub>'.$text.'</sub>',
                'superscript' => '<sup>'.$text.'</sup>',
                'link' => $this->link($text, $mark),
                default => $text,
            };
        }

        return $text;
    }

    /**
     * @param  array<string, mixed>  $mark
     */
    private function link(string $text, array $mark): string
    {
        $href = $mark['attrs']['href'] ?? '';

        if (! is_string($href) || ! preg_match('#^(https?:|mailto:)#i', $href)) {
            return $text;
        }

        return '<a href="'.e($href).'">'.$text.'</a>';
    }

    private function plainText(string $text): string
    {
        $paragraphs = preg_split("/\R{2,}/", trim($text)) ?: [];
        $html = '';

        foreach ($paragraphs as $paragraph) {
            if ($paragraph === '') {
                continue;
            }

            $html .= '<p>'.nl2br(e($paragraph), false).'</p>';
        }

        return $html;
    }
}
