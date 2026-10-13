<?php

namespace App\Enums;

enum PostStatusEnum:string
{
    case draft = 'draft';
    case published  = 'published ';
    case archived = 'archived';



}
