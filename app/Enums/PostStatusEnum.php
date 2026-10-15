<?php

namespace App\Enums;

enum PostStatusEnum:string
{
    case published  = 'published ';
    case draft = 'draft';
    case archived = 'archived';
    case scheduled  = 'scheduled ';
}
