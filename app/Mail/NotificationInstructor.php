<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationInstructor extends Mailable
{
    use Queueable, SerializesModels;

    public $date;
    public $description;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($date,$description)
    {
        $this->date = $date;
        $this->description = $description;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'NOVEDAD EN EL AMBIENTE DE FORMACIÓN',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.notificationNovely',
            with:[
                'date' => $this->date,
                'description' => $this->description
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
