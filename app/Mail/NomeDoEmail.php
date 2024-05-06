<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class NomeDoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $valor;

    public function __construct($nome, $valor)
    {
        $this->nome = $nome;
        $this->valor = $valor;
    }

    public function build()
    {
        return $this->view('emails.pagamento')
                    ->with(['nome' => $this->nome, 'valor' => $this->valor])
                    ->subject('Assunto do E-mail');
    }
}

