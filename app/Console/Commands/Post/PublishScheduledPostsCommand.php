<?php

namespace App\Console\Commands\Post;

use App\Enums\PostStatusEnum;
use App\Jobs\Post\PublishScheduledPostsJob;
use App\Models\Post;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

#[Signature('app:publish-scheduled-posts {date?}')]
#[Description('It publishes posts when the time comes.')]
class PublishScheduledPostsCommand extends Command
{
    /**
     * signature içerisinde argümanlar {} parantezleri içerisinde tanımlanır.
     * Örnek tanımlamalar;
     *
     * 1 - app:publish-scheduled-posts {status} => Status argümanını zorunlu istediğimizde bu şekilde kullanırız
     * 2 - app:publish-scheduled-posts {status?} => Status argümanını zorunlu istemediğimizde bu şekilde kullanırız
     */
    public function handle(): void
    {
        // Kullanıcı tarih girmezse bugünün tarihi alınır
        $date = Carbon::parse($this->argument('date') ?? now());

        // Belirlenen tarihteki status değeri scheduled olan postların id lerini çeker
        $postIds = Post::query()
            ->select('id')
            ->where('status', PostStatusEnum::scheduled)
            ->where('scheduled_at', $date->format('Y-m-d'))
            ->get()
            ->pluck('id')
            ->toArray();

        // Eğer post yoksa işlem sonlanır
        if (empty($postIds)) {
            return;
        }

        PublishScheduledPostsJob::dispatch($postIds, $date);

        $this->info('Process initiated. A log email will be sent to the admins.');
    }
}
