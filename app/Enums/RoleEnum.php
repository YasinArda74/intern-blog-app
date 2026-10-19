<?php

namespace App\Enums;

use Illuminate\Support\HtmlString;

enum RoleEnum: string
{
    case admin = 'admin';

    case user = 'user';

    case author = 'author';

    public static function getFieldName(string $role): HtmlString
    {
        $color = match (self::tryFrom($role)) {
            self::admin => 'bg-red-500',
            self::author => 'bg-blue-500',
            self::user => 'bg-gray-400',
        };

        return new HtmlString(sprintf(
            '<span class="text-xs font-medium px-2.5 py-0.5 rounded-sm %s text-white">%s</span>',
            $color,
            trans($role)
        ));
    }
}
