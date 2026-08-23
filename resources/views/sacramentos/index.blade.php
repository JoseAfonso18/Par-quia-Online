@extends('layouts.app')

@section('title', 'Sacramentos')

@section('content')
<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-heart"></i></span>
        <div>
            <p class="admin-title">Batizados e casamentos</p>
            <span class="admin-sub">Como agendar e quais documentos são necessários</span>
        </div>
    </div>
</div>

<div class="alert d-flex align-items-start gap-2" style="background-color:#fff7e6; border:1px solid #f0d080; color:#8a5a00;">
    <i class="bi bi-info-circle-fill mt-1"></i>
    <div>
        <strong>O agendamento é feito pessoalmente na secretaria paroquial.</strong><br>
        <span class="small">
            Batizados e casamentos envolvem preparação e documentação, por isso a conversa com o pároco
            é sempre presencial. Use o WhatsApp para marcar essa conversa e tirar dúvidas iniciais.
        </span>
    </div>
</div>

<div class="row g-4">

    {{-- BATIZADO --}}
    <div class="col-lg-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header text-white" style="background-color:#1a3a5c;">
                <strong><i class="bi bi-droplet"></i> Batizado</strong>
            </div>
            <div class="card-body d-flex flex-column">
                <p class="small text-muted">
                    O batismo é a porta de entrada na vida cristã. Os pais e padrinhos participam de uma
                    preparação antes da celebração.
                </p>

                <h6 class="mt-2 mb-3" style="color:#1a3a5c;">Passo a passo</h6>
                <div class="passo">
                    <span class="num">1</span>
                    <div class="small">Procure a secretaria paroquial para informar o interesse.</div>
                </div>
                <div class="passo">
                    <span class="num">2</span>
                    <div class="small">Entregue a documentação dos pais, do padrinho e da madrinha.</div>
                </div>
                <div class="passo">
                    <span class="num">3</span>
                    <div class="small">Participe do encontro de preparação para pais e padrinhos.</div>
                </div>
                <div class="passo">
                    <span class="num">4</span>
                    <div class="small">Confirme a data da celebração com a secretaria.</div>
                </div>

                <h6 class="mt-3 mb-2" style="color:#1a3a5c;">Documentos</h6>
                <ul class="small text-muted">
                    <li>Certidão de nascimento da criança</li>
                    <li>Documento com foto dos pais</li>
                    <li>Documento com foto dos padrinhos</li>
                    <li>Comprovante de endereço</li>
                </ul>

                <div class="mt-auto pt-2">
                    <x-whatsapp-btn
                        mensagem="Olá, vim pelo site da paróquia e gostaria de agendar uma conversa sobre *batizado*."
                        rotulo="Agendar conversa sobre batizado"
                        classe="btn btn-whats w-100" />
                </div>
            </div>
        </div>
    </div>

    {{-- CASAMENTO --}}
    <div class="col-lg-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header text-white" style="background-color:#1a3a5c;">
                <strong><i class="bi bi-heart"></i> Casamento</strong>
            </div>
            <div class="card-body d-flex flex-column">
                <p class="small text-muted">
                    O casamento exige preparação dos noivos e reserva antecipada da data. Procure a
                    paróquia com bastante antecedência para organizar tudo com calma.
                </p>

                <h6 class="mt-2 mb-3" style="color:#1a3a5c;">Passo a passo</h6>
                <div class="passo">
                    <span class="num">1</span>
                    <div class="small">Procure a secretaria para conversar com o pároco.</div>
                </div>
                <div class="passo">
                    <span class="num">2</span>
                    <div class="small">Reserve a data e o horário da celebração.</div>
                </div>
                <div class="passo">
                    <span class="num">3</span>
                    <div class="small">Participe do curso de preparação para noivos.</div>
                </div>
                <div class="passo">
                    <span class="num">4</span>
                    <div class="small">Entregue a documentação completa no prazo combinado.</div>
                </div>
                <div class="passo">
                    <span class="num">5</span>
                    <div class="small">Celebração do matrimônio.</div>
                </div>

                <h6 class="mt-3 mb-2" style="color:#1a3a5c;">Documentos</h6>
                <ul class="small text-muted">
                    <li>Certidão de batismo atualizada dos noivos</li>
                    <li>Documento com foto e CPF dos noivos</li>
                    <li>Comprovante de endereço</li>
                    <li>Certificado do curso de noivos</li>
                    <li>Documento das testemunhas</li>
                </ul>

                <div class="mt-auto pt-2">
                    <x-whatsapp-btn
                        mensagem="Olá, vim pelo site da paróquia e gostaria de agendar uma conversa sobre *casamento*."
                        rotulo="Agendar conversa sobre casamento"
                        classe="btn btn-whats w-100" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-4">
    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div class="small text-muted">
            <div class="mb-1"><i class="bi bi-clock"></i> Atendimento: segunda a sexta, 09h às 12h e 14h às 17h</div>
            <div><i class="bi bi-telephone"></i> {{ config('paroquia.telefone') }}
                <span class="ms-2"><i class="bi bi-geo-alt"></i> Caixa Postal, 10 — Pitanga/PR</span>
            </div>
        </div>
        <a href="{{ route('contato') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-envelope"></i> Outras formas de contato
        </a>
    </div>
</div>

<p class="small text-muted mt-3 mb-0">
    <i class="bi bi-info-circle"></i>
    Prazos, documentos e datas disponíveis devem ser confirmados diretamente com a secretaria paroquial.
</p>
@endsection
