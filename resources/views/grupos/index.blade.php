@extends('layouts.app')

@section('title', 'Grupos da Paróquia')

@section('content')
<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-people-fill"></i></span>
        <div>
            <p class="admin-title">Grupos e pastorais</p>
            <span class="admin-sub">Conheça e participe das atividades da nossa comunidade</span>
        </div>
    </div>
</div>

@if($grupos->isEmpty())
    <div class="alert alert-info">Nenhum grupo cadastrado no momento.</div>
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($grupos as $grupo)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($grupo->imagem)
                        <img src="{{ asset($grupo->imagem) }}" class="card-foto-topo" alt="{{ $grupo->nome }}">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="mb-2" style="color:#1a3a5c;">
                            <i class="bi bi-people-fill"></i> {{ $grupo->nome }}
                        </h5>
                        <p class="card-text small text-muted">{{ $grupo->descricao }}</p>

                        <div class="small text-muted mb-3">
                            @if($grupo->responsavel)
                                <div class="mb-1"><i class="bi bi-person"></i> Responsável: {{ $grupo->responsavel }}</div>
                            @endif
                            @if($grupo->dia_reuniao)
                                <div class="mb-1">
                                    <i class="bi bi-calendar3"></i> {{ $grupo->dia_reuniao }}
                                    @if($grupo->horario_reuniao)
                                        às {{ \Carbon\Carbon::parse($grupo->horario_reuniao)->format('H:i') }}
                                    @endif
                                </div>
                            @endif
                            @if($grupo->local)
                                <div><i class="bi bi-geo-alt"></i> {{ $grupo->local }}</div>
                            @endif
                        </div>

                        <div class="mt-auto d-flex flex-wrap gap-2 align-items-center">
                            @auth
                                @if(Auth::user()->is_admin)
                                @elseif(in_array($grupo->id, $gruposInscritos))
                                    <form action="{{ route('grupos.cancelar', $grupo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-x-circle"></i> Cancelar inscrição
                                        </button>
                                    </form>
                                    <span class="badge bg-success"><i class="bi bi-check"></i> Inscrito</span>
                                @else
                                    <form action="{{ route('grupos.inscrever', $grupo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm text-white" style="background-color:#1a3a5c;">
                                            <i class="bi bi-person-plus"></i> Participar
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-person"></i> Faça login para se inscrever
                                </a>
                            @endauth

                            <x-whatsapp-btn
                                :mensagem="'Olá, vim pelo site da paróquia e gostaria de participar do grupo *' . $grupo->nome . '*.'"
                                rotulo="WhatsApp" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <p class="small text-muted mt-3 mb-0">
        <i class="bi bi-info-circle"></i>
        Prefere não criar uma conta? Toque em WhatsApp e a secretaria faz a sua inscrição.
    </p>
@endif
@endsection
