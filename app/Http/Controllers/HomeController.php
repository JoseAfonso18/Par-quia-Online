<?php

namespace App\Http\Controllers;

use App\Models\Missa;
use App\Models\Evento;
use App\Models\Aviso;
use App\Models\Grupo;
use App\Mail\ContatoRecebido;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * Páginas institucionais públicas: Home, Sobre e Contato
 * (US009, US011, US012 e US015).
 */
class HomeController extends Controller
{
    /**
     * Monta a página inicial reunindo três blocos de destaque:
     * os 3 próximos eventos a partir de hoje, as missas ativas de domingo
     * e o aviso mais recente marcado como destaque (US009).
     */
    public function index()
    {
        $proximosEventos = Evento::where('data', '>=', now()->toDateString())
            ->orderBy('data', 'asc')
            ->take(3)
            ->get();

        // Todos os avisos marcados como destaque, e não apenas o mais recente.
        $avisosDestaque = Aviso::where('destaque', true)
            ->latest()
            ->take(3)
            ->get();

        $gruposDestaque = Grupo::where('ativo', true)
            ->orderBy('nome')
            ->take(3)
            ->get();

        $proximaMissa = Missa::proxima();
        $missasSemana = Missa::listarOrdenadas()->where('ativo', true)->values();

        return view('home', compact(
            'proximosEventos', 'avisosDestaque', 'gruposDestaque', 'proximaMissa', 'missasSemana'
        ));
    }

    /**
     * Página informativa da Catequese: turmas, horários e documentos.
     */
    public function catequese()
    {
        return view('catequese.index');
    }

    /**
     * Página dos sacramentos que exigem agendamento presencial
     * (batizado e casamento), com o passo a passo e os documentos.
     */
    public function sacramentos()
    {
        return view('sacramentos.index');
    }

    /**
     * Página institucional 'Sobre' — conteúdo estático (US011).
     */
    public function sobre()
    {
        return view('sobre');
    }

    /**
     * Exibe o formulário de contato, informando na view o e-mail de destino
     * configurado em PAROQUIA_EMAIL_DESTINO (US012).
     */
    public function contato()
    {
        $emailDestino = env('PAROQUIA_EMAIL_DESTINO', 'engs-luisdomingues@camporeal.edu.br');

        return view('contato.index', compact('emailDestino'));
    }

    /**
     * Valida e envia a mensagem do formulário de contato por SMTP (US015).
     *
     * Falhas de envio (SMTP indisponível, credenciais ausentes em desenvolvimento)
     * são registradas no log e não interrompem a navegação: o usuário recebe uma
     * confirmação neutra, sem exposição de detalhes técnicos.
     */
    public function contatoEnviar(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email',
            'assunto'  => 'required|string|max:255',
            'mensagem' => 'required|string',
        ], [
            'nome.required'     => 'Informe seu nome.',
            'email.required'    => 'Informe seu e-mail.',
            'email.email'       => 'E-mail inválido.',
            'assunto.required'  => 'Informe o assunto.',
            'mensagem.required' => 'Escreva sua mensagem.',
        ]);

        // US015 - Envio real de e-mail via SMTP (Sprint 3)
        $destinatario = config('mail.paroquia_destino', env('PAROQUIA_EMAIL_DESTINO', 'engs-luisdomingues@camporeal.edu.br'));

        try {
            Mail::to($destinatario)->send(new ContatoRecebido(
                $request->nome,
                $request->email,
                $request->assunto,
                $request->mensagem
            ));

            return back()->with('sucesso', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
        } catch (\Throwable $e) {
            // Em ambiente de desenvolvimento sem SMTP configurado, registra no log
            // e ainda retorna feedback positivo ao usuário para evitar exposição de erro técnico.
            Log::warning('Falha ao enviar e-mail de contato: ' . $e->getMessage());

            return back()->with('sucesso', 'Mensagem registrada! Entraremos em contato em breve.');
        }
    }
}
