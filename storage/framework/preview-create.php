<?php

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;

require __DIR__.'/../../vendor/autoload.php';

$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

View::share('errors', new ViewErrorBag);
View::share('authUser', null);

file_put_contents(__DIR__.'/../../public/_preview-create.html', view('posts.create', [
    'categories' => Category::query()->orderBy('name')->limit(3)->get(),
])->render());
