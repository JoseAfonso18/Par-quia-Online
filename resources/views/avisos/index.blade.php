@extends('layouts.app')

@section('title', 'Avisos')

@section('content')
@php
    $destaques = $avisos->where('destaque', true);
    $demais    = $avisos->where('destaque', false);
@endphp

<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-megaphone"></i></span>
        <div>
            <p class="admin-title">Avisos da paróquia</p>
            <span class="admin-sub">Fique por dentro dos comunicados da secretaria</span>
        </div>
    </div>
</div>

@if($avisos->isEmpty())
    <div class="alert alert-info">Nenhum aviso publicado no momento.</div>
@else

    @if($destaques->isNotEmpty())
        <h5 class="mb-3" style="color:#1a3a5c;">
            <i class="bi bi-star-fill" style="color:#b8860b;"></i> Em destaque
        </h5>
        @foreach($destaques as $aviso)
            <div class="card shadow-sm mb-3" style="border-left:4px solid #b8860b;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <h5 class="mb-2" style="color:#1a3a5c;">{{ $aviso->titulo }}</h5>
                        <span class="badge" style="background-color:#fdecc8; color:#8a5a00;">destaque</span>
                    </div>
                    <p class="card-text">{{ $aviso->conteudo }}</p>
                    <small class="text-muted">
                        <i class="bi bi-calendar-event"></i>
                        Publicado em {{ $aviso->created_at->format('d/m/Y') }}
                    </small>
                </div>
            </div>
        @endforeach
    @endif

    @if($demais->isNotEmpty())
        <h5 class="mb-3 mt-4" style="color:#1a3a5c;">
            <i class="bi bi-list-ul"></i> Outros avisos
        </h5>
        @foreach($demais as $aviso)
            <div class="card shadow-sm mb-3" style="border-left:4px solid #cdd6df;">
                <div class="card-body">
                    <h5 class="mb-2" style="color:#1a3a5c;">{{ $aviso->titulo }}</h5>
                    <p class="card-text">{{ $aviso->conteudo }}</p>
                    <small class="text-muted">
                        <i class="bi bi-calendar-event"></i>
                        Publicado em {{ $aviso->created_at->format('d/m/Y') }}
                    </small>
                </div>
            </div>
        @endforeach
    @endif

    <p class="small text-muted mt-3 mb-0">
        <i class="bi bi-info-circle"></i>
        Avisos em destaque também aparecem na página inicial do site.
    </p>
@endif
@endsection
