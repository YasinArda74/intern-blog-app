<?php

namespace App\Http\Requests\Admin\Tags;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTagsRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Eğer kullanıcı admin değilse engelle
        if (! $this->user()->hasRole(RoleEnum::admin)) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        $tag = $this->route('tag');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags', 'name')->ignore($tag),
            ],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
