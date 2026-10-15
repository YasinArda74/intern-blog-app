<?php

namespace App\Mail\Post;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class PublishScheduledPostsMail extends Mailable
{
    use Queueable, SerializesModels;

    private Carbon $scheduledDate;

    public function __construct(Carbon $scheduledDate)
    {
        $this->scheduledDate = $scheduledDate;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Publish Scheduled Posts Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mails.posts.publish_scheduled_posts_mail',
            with: [
                'scheduledDate' => $this->scheduledDate->format('Y-m-d'),
            ],
        );
    }
}
