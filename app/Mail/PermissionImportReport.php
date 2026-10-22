<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class PermissionImportReport extends Mailable
{
    public function __construct(
        public int $created,
        public int $existing,
        public int $empty,
        public ?string $error = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->error
                ? 'Permission import hata verdi'
                : 'Permission import tamamlandı',
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mails.permission_import_report');
    }
}
