@extends('layouts.app')

@section('title', 'Painel Admin')

@section('content')
@php
    $meses = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];
@endphp

{{-- Barra de identificação do painel --}}
<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo">
            <i class="bi bi-gear"></i>
        </span>
        <div>
            <p class="admin-title">Painel administrativo</p>
            <span class="admin-sub">Paróquia N. S. da Glória · Pitanga/PR</span>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <i class="bi bi-person-circle fs-5"></i>
        <span class="small">{{ Auth::user()->name }}</span>
    </div>
</div>

{{-- Cartões de totais --}}
<div class="row g-3 mb-3">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Eventos</span>
                <i class="bi bi-calendar-event stat-ico"></i>
            </div>
            <div class="stat-num">{{ $totalEventos }}</div>
            <div class="stat-foot">{{ $eventosProximosTotal }} {{ $eventosProximosTotal == 1 ? 'próximo' : 'próximos' }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Avisos</span>
                <i class="bi bi-megaphone stat-ico"></i>
            </div>
            <div class="stat-num">{{ $totalAvisos }}</div>
            <div class="stat-foot">{{ $avisosDestaqueTotal }} em destaque</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Missas</span>
                <i class="bi bi-clock stat-ico"></i>
            </div>
            <div class="stat-num">{{ $totalMissas }}</div>
            <div class="stat-foot">{{ $missasAtivasTotal }} {{ $missasAtivasTotal == 1 ? 'ativa' : 'ativas' }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Grupos</span>
                <i class="bi bi-people stat-ico"></i>
            </div>
            <div class="stat-num">{{ $totalGrupos }}</div>
            <div class="stat-foot">{{ $totalInscritos }} {{ $totalInscritos == 1 ? 'inscrito' : 'inscritos' }}</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    {{-- Próximos eventos --}}
    <div class="col-lg-6">
        <div class="panel-card">
            <div class="panel-title"><i class="bi bi-calendar-event"></i> Próximos eventos</div>

            @forelse($proximosEventos as $evento)
                @php $data = \Carbon\Carbon::parse($evento->data); @endphp
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="date-chip">
                        <div class="d">{{ $data->format('d') }}</div>
                        <div class="m">{{ $meses[$data->format('n') - 1] }}</div>
                    </div>
                    <div>
                        <div class="fw-semibold small">{{ $evento->titulo }}</div>
                        <div class="text-muted small">
                            @if($evento->horario)
                                {{ \Carbon\Carbon::parse($evento->horario)->format('H:i') }} ·
                            @endif
                            {{ $evento->local ?? 'Local a definir' }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted small mb-0">Nenhum evento futuro cadastrado.</p>
            @endforelse

            <a href="{{ route('admin.eventos') }}" class="small text-decoration-none" style="color:#185fa5;">
                Ver todos os eventos <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Grupos com mais inscritos --}}
    <div class="col-lg-6">
        <div class="panel-card">
            <div class="panel-title"><i class="bi bi-bar-chart"></i> Grupos com mais inscritos</div>

            @forelse($gruposTop as $grupo)
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>{{ $grupo->nome }}</span>
                        <span class="text-muted">{{ $grupo->inscritos_count }}</span>
                    </div>
                    <div class="bar-track">
                        <div class="bar-fill" style="width: {{ round(($grupo->inscritos_count / $maxInscritos) * 100) }}%;"></div>
                    </div>
                </div>
            @empty
                <p class="text-muted small mb-0">Nenhum grupo cadastrado.</p>
            @endforelse

            <a href="{{ route('admin.grupos') }}" class="small text-decoration-none" style="color:#185fa5;">
                Gerenciar grupos <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Avisos recentes --}}
    <div class="col-lg-6">
        <div class="panel-card">
            <div class="panel-title"><i class="bi bi-megaphone"></i> Avisos recentes</div>

            @forelse($avisosRecentes as $aviso)
                <div class="d-flex align-items-center gap-2 mb-2 small">
                    @if($aviso->destaque)
                        <span class="badge" style="background-color:#fdecc8; color:#8a5a00;">destaque</span>
                    @else
                        <i class="bi bi-dot text-muted"></i>
                    @endif
                    <span class="{{ $aviso->destaque ? '' : 'text-muted' }}">{{ $aviso->titulo }}</span>
                </div>
            @empty
                <p class="text-muted small mb-0">Nenhum aviso publicado.</p>
            @endforelse

            <a href="{{ route('admin.avisos') }}" class="small text-decoration-none" style="color:#185fa5;">
                Gerenciar avisos <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Ações rápidas --}}
    <div class="col-lg-6">
        <div class="panel-card">
            <div class="panel-title"><i class="bi bi-lightning-charge"></i> Ações rápidas</div>
            <div class="row g-2">
                <div class="col-6">
                    <a href="{{ route('admin.eventos.criar') }}" class="btn btn-outline-secondary w-100 btn-sm">
                        <i class="bi bi-plus"></i> Novo evento
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('admin.avisos.criar') }}" class="btn btn-outline-secondary w-100 btn-sm">
                        <i class="bi bi-plus"></i> Novo aviso
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('admin.missas.criar') }}" class="btn btn-outline-secondary w-100 btn-sm">
                        <i class="bi bi-plus"></i> Nova missa
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('admin.grupos.criar') }}" class="btn btn-outline-secondary w-100 btn-sm">
                        <i class="bi bi-plus"></i> Novo grupo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
