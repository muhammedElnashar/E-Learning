<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
use Queueable, SerializesModels;
public $data;

public function __construct($data)
{
$this->data = $data;
}

public function envelope(): Envelope
{
return new Envelope(
subject: 'Subscription Successful',
);
}

public function content(): Content
{
return new Content(
view: 'emails.notification',
);
}

public function attachments(): array
{
return [];
}
}
