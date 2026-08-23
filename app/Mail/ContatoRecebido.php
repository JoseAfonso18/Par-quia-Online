<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Mensagem enviada à secretaria a partir do formulário de contato (US015).
 *
 * O remetente do e-mail é a conta configurada em MAIL_FROM_ADDRESS; o e-mail
 * informado pelo fiel entra como Reply-To, permitindo responder diretamente
 * sem que a aplicação precise forjar o remetente (prática bloqueada por SPF/DKIM).
 */
class ContatoRecebido extends Mailable
{
    use Queueable, SerializesModels;

    public string $nomeRemetente;
    public string $emailRemetente;
    public string $assunto;
    public string $mensagem;

    public function __construct(string $nomeRemetente, string $emailRemetente, string $assunto, string $mensagem)
    {
        $this->nomeRemetente  = $nomeRemetente;
        $this->emailRemetente = $emailRemetente;
        $this->assunto        = $assunto;
        $this->mensagem       = $mensagem;
    }

    /**
     * Monta o assunto prefixado, define o Reply-To do fiel e
     * renderiza a view resources/views/emails/contato.blade.php.
     */
    public function build()
    {
        return $this->subject('[Contato Paróquia] ' . $this->assunto)
                    ->replyTo($this->emailRemetente, $this->nomeRemetente)
                    ->view('emails.contato');
    }
}
