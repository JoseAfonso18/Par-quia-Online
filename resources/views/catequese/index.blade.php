@extends('layouts.app')

@section('title', 'Catequese')

@section('content')
<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-book"></i></span>
        <div>
            <p class="admin-title">Catequese</p>
            <span class="admin-sub">Formação na fé para crianças, jovens e adultos</span>
        </div>
    </div>
    <x-whatsapp-btn
        mensagem="Olá, vim pelo site da paróquia e gostaria de informações sobre a inscrição na catequese."
        rotulo="Inscrever pelo WhatsApp" />
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <p class="mb-0">
            A catequese da paróquia realiza-se <strong>aos sábados e domingos</strong>, ministrada pelas
            <strong>Irmãs Servas de Maria Imaculada</strong>, pelas <strong>Catequistas do Sagrado Coração</strong>
            e por catequistas leigas da comunidade. As inscrições acontecem no início de cada ano,
            na secretaria paroquial ou pelo WhatsApp.
        </p>
    </div>
</div>

<h5 class="mb-3" style="color:#1a3a5c;"><i class="bi bi-mortarboard"></i> Turmas oferecidas</h5>

@php
    $turmas = [
        ['nome' => 'Iniciação à fé',      'idade' => '7 a 9 anos',           'desc' => 'Primeiro contato com a fé, as orações e a história da salvação.', 'quando' => 'Sábado, 14:00'],
        ['nome' => 'Primeira Eucaristia', 'idade' => '10 a 12 anos',         'desc' => 'Preparação para receber o sacramento da Primeira Comunhão.',      'quando' => 'Sábado, 15:30'],
        ['nome' => 'Crisma',              'idade' => '13 anos ou mais',      'desc' => 'Preparação para o sacramento da Confirmação (Crisma).',           'quando' => 'Domingo, 09:00'],
        ['nome' => 'Catequese de adultos','idade' => 'a partir de 18 anos',  'desc' => 'Para adultos que ainda não receberam os sacramentos ou desejam aprofundar a fé.', 'quando' => 'Domingo, 10:30'],
    ];
@endphp

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3 mb-4">
    @foreach($turmas as $turma)
        <div class="col">
            <div class="card h-100 shadow-sm" style="border-left:4px solid #cdd6df;">
                <div class="card-body d-flex flex-column">
                    <h6 class="mb-2" style="color:#1a3a5c;">{{ $turma['nome'] }}</h6>
                    <span class="badge mb-2 align-self-start" style="background-color:#e6f1fb; color:#0c447c;">
                        {{ $turma['idade'] }}
                    </span>
                    <p class="small text-muted">{{ $turma['desc'] }}</p>
                    <div class="small text-muted mb-3"><i class="bi bi-clock"></i> {{ $turma['quando'] }}</div>
                    <div class="mt-auto">
                        <x-whatsapp-btn
                            :mensagem="'Olá, vim pelo site da paróquia e gostaria de informações sobre a inscrição na catequese — turma *' . $turma['nome'] . '*.'"
                            rotulo="Quero informações" />
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header text-white" style="background-color:#1a3a5c;">
                <strong><i class="bi bi-clipboard-check"></i> Documentos para inscrição</strong>
            </div>
            <div class="card-body">
                <ul class="mb-0 small">
                    <li class="mb-2">Certidão de batismo do catequizando</li>
                    <li class="mb-2">Documento com foto do responsável</li>
                    <li>Comprovante de endereço</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header text-white" style="background-color:#1a3a5c;">
                <strong><i class="bi bi-info-circle"></i> Como se inscrever</strong>
            </div>
            <div class="card-body d-flex flex-column">
                <p class="small text-muted">
                    As inscrições são feitas na secretaria paroquial, dentro do horário de atendimento,
                    ou pelo WhatsApp. Dúvidas sobre turmas, idades ou documentos podem ser tiradas
                    diretamente com a secretaria.
                </p>
                <div class="small text-muted mb-3">
                    <div class="mb-1"><i class="bi bi-clock"></i> Segunda a sexta, 09h às 12h e 14h às 17h</div>
                    <div><i class="bi bi-geo-alt"></i> Caixa Postal, 10 — Pitanga/PR</div>
                </div>
                <div class="mt-auto">
                    <x-whatsapp-btn
                        mensagem="Olá, vim pelo site da paróquia e gostaria de informações sobre a inscrição na catequese."
                        rotulo="Falar com a catequese" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
