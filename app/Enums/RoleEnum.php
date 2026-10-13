<?php

namespace App\Enums;

enum RoleEnum: string
{
    case admin = 'admin';

    case user = 'user';

    case author = 'author';
}
