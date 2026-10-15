<?php

namespace App\Jobs\Post;

use App\Enums\PostStatusEnum;
use App\Mail\Post\PublishScheduledPostsMail;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PublishScheduledPostsJob implements ShouldQueue
{
    use Queueable;

    private array $postIds;

    private Carbon $scheduledDate;

    public function __construct(array $postIds, Carbon $scheduledDate)
    {
        $this->postIds = $postIds;
        $this->scheduledDate = $scheduledDate;
    }

    public function handle(): void
    {
        try {
            DB::transaction(function () {
                Post::query()->whereIn('id', $this->postIds)->update([
                    'published_at' => now(),
                    'status' => PostStatusEnum::published,
                ]);
            });

            Mail::to('admin@gmail.com')->send(new PublishScheduledPostsMail($this->scheduledDate));
        } catch (\Throwable $e) {
            Log::error('PublishScheduledPostsJob Error: '.$e->getMessage());
        }
    }
}
