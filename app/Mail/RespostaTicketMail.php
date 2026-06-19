<?php

namespace App\Mail;

use App\Models\Ticket;
use App\Models\Resposta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RespostaTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $resposta;

    public function __construct(Ticket $ticket, Resposta $resposta)
    {
        $this->ticket = $ticket;
        $this->resposta = $resposta;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nova Resposta no Ticket {$this->ticket->numero_ticket} - Tickets Inovcorp",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.resposta-ticket',
        );
    }
}