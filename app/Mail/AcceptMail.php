<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AcceptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $prenom;
    public $service;
    public $date_debut;
    public $date_fin;

    public function __construct($nom, $prenom, $service, $date_debut, $date_fin)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->service = $service;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }

    public function build()
    {
        return $this->subject('Acceptation de demande de stage')
                ->view('emails.accept-demande-stage')
                ->with([
                    'nom' => $this->nom,
                    'prenom' => $this->prenom,
                    'service' => $this->service,
                    'date_debut' => $this->date_debut,
                    'date_fin' => $this->date_fin,
                ]);
    }
}
