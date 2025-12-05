<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $motif;

    public function __construct($motif)
    {
        $this->motif = $motif;
    }

    public function build()
    {
        return $this->subject('Rejet de demande de stage')
                ->view('emails.reject-demande-stage')
                ->with([
                    'motif' => $this->motif,
                ]);
    }
}
