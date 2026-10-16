<?php

use App\Console\Commands\Post\PublishScheduledPostsCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(PublishScheduledPostsCommand::class)->dailyAt('04:00');

