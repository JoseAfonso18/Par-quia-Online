@extends('layouts.app')

@section('title', 'Início')

@section('hero')
{{-- Hero com carrossel de imagens (5s) --}}
<section class="hero-igreja">
    <div class="hero-igreja-slides" aria-hidden="true">
        <div class="hero-slide active" style="background-image: url('{{ asset('images/sobre7.jpg') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/sobre8.jpg') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/igreja4k.png') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/sobre4.jpeg') }}');"></div>
    </div>
    <div class="container">
        <h1 class="mb-2"><i class="bi bi-house-heart"></i> Paróquia Nossa Senhora da Glória</h1>
        <p class="lead mb-4">
            Igreja Católica Ucraniana · Rito Bizantino · Pitanga/PR<br>
            Bem-vindo à nossa comunidade de fé desde 1952
        </p>
        <a href="{{ route('missas.index') }}" class="btn btn-hero me-2">
            <i class="bi bi-clock"></i> Horários de missas
        </a>
        <a href="{{ route('sobre') }}" class="btn btn-outline-light">
            <i class="bi bi-info-circle"></i> Conheça a paróquia
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length < 2) return;
    let atual = 0;
    setInterval(function () {
        slides[atual].classList.remove('active');
        atual = (atual + 1) % slides.length;
        slides[atual].classList.add('active');
    }, 5000);
})();
</script>
@endpush

@section('content')
@php
    $meses = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];
    $siglas = ['DOM', 'SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SÁB'];
    $hojeIdx = (int) now()->dayOfWeek;

    // Agrupa os horários por dia da semana para montar a faixa da semana.
    $porDia = [];
    foreach ($missasSemana as $m) {
        $idx = \App\Models\Missa::indiceDia($m->dia_semana);
        if ($idx !== null) {
            $porDia[$idx][] = \Carbon\Carbon::parse($m->horario)->format('H:i');
        }
    }
@endphp

{{-- Próxima missa + agenda da semana --}}
@if($proximaMissa)
    <div class="prox-missa d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="rotulo">Próxima missa</div>
            <div class="valor">{{ $proximaMissa['quando'] }}, às {{ $proximaMissa['horario'] }}</div>
            <div class="detalhe">
                <i class="bi bi-geo-alt"></i> {{ $proximaMissa['missa']->local ?? 'Igreja Matriz' }}
                @if($proximaMissa['missa']->observacao)
                    · {{ $proximaMissa['missa']->observacao }}
                @endif
            </div>
        </div>
        <a href="{{ route('missas.index') }}" class="btn btn-outline-light">
            <i class="bi bi-calendar-week"></i> Ver todos os horários
        </a>
    </div>

    <div class="row row-cols-7 g-2 mb-4" style="--bs-columns: 7;">
        @for($i = 0; $i < 7; $i++)
            <div class="col">
                <div class="dia-col {{ $i === $hojeIdx ? 'hoje' : '' }} {{ $i === 0 ? 'domingo' : '' }}">
                    <div class="cab">{{ $siglas[$i] }}</div>
                    <div class="corpo">
                        @forelse($porDia[$i] ?? [] as $h)
                            <div class="hh">{{ $h }}</div>
                        @empty
                            <div class="vazio">—</div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endif

{{-- Avisos em destaque --}}
@if($avisosDestaque->isNotEmpty())
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0" style="color:#1a3a5c;"><i class="bi bi-megaphone"></i> Avisos em destaque</h4>
        <a href="{{ route('avisos.index') }}" class="text-decoration-none small" style="color:#185fa5;">
            Ver todos os avisos <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
        @foreach($avisosDestaque as $aviso)
            <div class="col">
                <div class="card h-100 shadow-sm" style="border-left:4px solid #b8860b;">
                    <div class="card-body">
                        <span class="badge" style="background-color:#fdecc8; color:#8a5a00;">destaque</span>
                        <h6 class="mt-2 mb-1" style="color:#1a3a5c;">{{ $aviso->titulo }}</h6>
                        <p class="card-text small text-muted mb-0">
                            {{ \Illuminate\Support\Str::limit($aviso->conteudo, 110) }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{{-- Próximos eventos --}}
<div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="mb-0" style="color:#1a3a5c;"><i class="bi bi-calendar-event"></i> Próximos eventos</h4>
    <a href="{{ route('eventos.index') }}" class="text-decoration-none small" style="color:#185fa5;">
        Ver todos os eventos <i class="bi bi-arrow-right"></i>
    </a>
</div>
<div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
    @forelse($proximosEventos as $evento)
        @php $data = \Carbon\Carbon::parse($evento->data); @endphp
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="position-relative">
                    @if($evento->imagem)
                        <img src="{{ asset($evento->imagem) }}" class="card-foto-topo" alt="{{ $evento->titulo }}">
                    @else
                        <img src="{{ asset('images/sobre1.jpeg') }}" class="card-foto-topo" alt="" aria-hidden="true">
                    @endif
                    <div class="data-sobre">
                        <div class="d">{{ $data->format('d') }}</div>
                        <div class="m">{{ $meses[$data->format('n') - 1] }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-1" style="color:#1a3a5c;">{{ $evento->titulo }}</h6>
                    <p class="small text-muted mb-2">{{ \Illuminate\Support\Str::limit($evento->descricao, 95) }}</p>
                    <div class="small text-muted">
                        @if($evento->horario)
                            <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($evento->horario)->format('H:i') }}
                        @endif
                        @if($evento->local)
                            <span class="ms-2"><i class="bi bi-geo-alt"></i> {{ $evento->local }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info mb-0">Nenhum evento próximo no momento.</div></div>
    @endforelse
</div>

{{-- Grupos --}}
@if($gruposDestaque->isNotEmpty())
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0" style="color:#1a3a5c;"><i class="bi bi-people"></i> Nossos grupos e pastorais</h4>
        <a href="{{ route('grupos.index') }}" class="text-decoration-none small" style="color:#185fa5;">
            Ver todos os grupos <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
        @foreach($gruposDestaque as $grupo)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($grupo->imagem)
                        <img src="{{ asset($grupo->imagem) }}" class="card-foto-topo" alt="{{ $grupo->nome }}">
                    @else
                        <img src="{{ asset('images/sobre1.jpeg') }}" class="card-foto-topo" alt="" aria-hidden="true">
                    @endif
                    <div class="card-body">
                        <h6 class="mb-1" style="color:#1a3a5c;">{{ $grupo->nome }}</h6>
                        <p class="small text-muted mb-2">{{ \Illuminate\Support\Str::limit($grupo->descricao, 95) }}</p>
                        @if($grupo->dia_reuniao)
                            <div class="small text-muted">
                                <i class="bi bi-clock"></i> {{ $grupo->dia_reuniao }}
                                @if($grupo->horario_reuniao)
                                    às {{ \Carbon\Carbon::parse($grupo->horario_reuniao)->format('H:i') }}
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{{-- Casamentos e batizados --}}
<div class="banner-sacr d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="ico"><i class="bi bi-heart"></i></span>
        <div>
            <h6 class="mb-1" style="color:#1a3a5c;">Casamentos e batizados</h6>
            <p class="small text-muted mb-0">
                O agendamento é feito <strong>pessoalmente na secretaria</strong>, com antecedência.
                Veja os documentos necessários e marque sua conversa.
            </p>
        </div>
    </div>
    <a href="{{ route('sacramentos') }}" class="btn btn-sm text-white" style="background-color:#1a3a5c;">
        <i class="bi bi-arrow-right"></i> Ver informações
    </a>
</div>

{{-- Localização da paróquia --}}
<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: #1a3a5c;">
        <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Onde estamos</h5>
    </div>
    <div class="row g-0">
        <div class="col-md-4">
            <div class="card-body h-100 d-flex flex-column">
                <p class="mb-2">
                    <strong>Paróquia Nossa Senhora da Glória</strong><br>
                    <span class="text-muted">Igreja Católica Ucraniana</span>
                </p>
                <p class="mb-2 small">
                    <i class="bi bi-geo-alt text-muted"></i>
                    Caixa Postal, 10<br>
                    <span class="ms-3">85200-000, Pitanga, Paraná</span>
                </p>
                <p class="mb-3 small">
                    <i class="bi bi-telephone text-muted"></i> {{ config('paroquia.telefone') }}
                </p>
                <div class="d-flex gap-2 mt-auto flex-wrap">
                    <a href="https://www.google.com/maps/dir/?api=1&destination=Par%C3%B3quia+Nossa+Senhora+da+Gl%C3%B3ria%2C+Pitanga+-+PR"
                       target="_blank" rel="noopener"
                       class="btn btn-sm text-white" style="background-color:#1a3a5c;">
                        <i class="bi bi-map"></i> Como chegar
                    </a>
                    <x-whatsapp-btn
                        mensagem="Olá, vim pelo site da paróquia e gostaria de falar com a secretaria."
                        rotulo="WhatsApp" />
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <iframe
                class="mapa-paroquia"
                src="https://www.google.com/maps?q=Par%C3%B3quia+Nossa+Senhora+da+Gl%C3%B3ria%2C+Pitanga+-+PR&output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Mapa da localização da Paróquia Nossa Senhora da Glória, em Pitanga/PR"
                allowfullscreen></iframe>
        </div>
    </div>
</div>

@endsection
