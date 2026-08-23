@extends('layouts.app')

@section('title', 'Eventos e Festas')

@section('content')
@php
    $meses = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];
@endphp

<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-calendar-event"></i></span>
        <div>
            <p class="admin-title">Eventos e festas</p>
            <span class="admin-sub">Participe do que acontece na nossa comunidade</span>
        </div>
    </div>
</div>

@if($eventos->isEmpty())
    <div class="alert alert-info">
        Nenhum evento cadastrado no momento.
    </div>
@else
    <div class="row row-cols-1 row-cols-lg-2 g-4">
        @foreach($eventos as $evento)
            @php $data = \Carbon\Carbon::parse($evento->data); @endphp
            <div class="col">
                <div class="card h-100 shadow-sm overflow-hidden">
                    <div class="d-flex flex-column flex-sm-row h-100">
                        @if($evento->imagem)
                            <img src="{{ asset($evento->imagem) }}" class="card-foto-lado" alt="{{ $evento->titulo }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge" style="background-color:#fdecc8; color:#8a5a00;">
                                    {{ $data->format('d') }} de {{ $meses[$data->format('n') - 1] }}
                                </span>
                            </div>
                            <h5 class="mb-1" style="color:#1a3a5c;">{{ $evento->titulo }}</h5>
                            <p class="card-text small text-muted">{{ $evento->descricao }}</p>

                            <div class="small text-muted mb-3">
                                <span class="me-3">
                                    <i class="bi bi-calendar3"></i> {{ $data->format('d/m/Y') }}
                                </span>
                                @if($evento->horario)
                                    <span class="me-3">
                                        <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($evento->horario)->format('H:i') }}
                                    </span>
                                @endif
                                @if($evento->local)
                                    <span><i class="bi bi-geo-alt"></i> {{ $evento->local }}</span>
                                @endif
                            </div>

                            {{-- US008 - Voluntariado --}}
                            <div class="mt-auto d-flex flex-wrap gap-2 align-items-center">
                                @auth
                                    @if(Auth::user()->is_admin)
                                    @elseif(Auth::user()->eventosVoluntario->contains($evento->id))
                                        <form action="{{ route('voluntario.cancelar', $evento->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-x-circle"></i> Cancelar voluntariado
                                            </button>
                                        </form>
                                        <span class="badge bg-success"><i class="bi bi-check"></i> Voluntário</span>
                                    @else
                                        <form action="{{ route('voluntario.inscrever', $evento->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="mensagem" value="">
                                            <button type="submit" class="btn btn-sm text-white" style="background-color:#1a3a5c;">
                                                <i class="bi bi-hand-thumbs-up"></i> Quero ser voluntário
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-person"></i> Login para ser voluntário
                                    </a>
                                @endauth

                                <x-whatsapp-btn
                                    :mensagem="'Olá, vim pelo site da paróquia e gostaria de ser voluntário(a) no evento *' . $evento->titulo . '*, do dia ' . $data->format('d/m') . '.'"
                                    rotulo="WhatsApp" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <p class="small text-muted mt-3 mb-0">
        <i class="bi bi-info-circle"></i>
        Você pode se inscrever pelo site ou, se preferir, falar direto com a secretaria pelo WhatsApp.
    </p>
@endif
@endsection
