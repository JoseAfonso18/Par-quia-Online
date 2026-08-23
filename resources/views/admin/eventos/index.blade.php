@extends('layouts.app')

@section('title', 'Admin Eventos')

@section('content')
<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-calendar-event"></i></span>
        <div>
            <p class="admin-title">Gerenciar eventos</p>
            <span class="admin-sub">Painel administrativo · Paróquia N. S. da Glória</span>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.index') }}" class="btn btn-sm btn-outline-light">
            <i class="bi bi-arrow-left"></i> Painel
        </a>
        <a href="{{ route('admin.eventos.criar') }}" class="btn btn-sm btn-topbar">
            <i class="bi bi-plus-circle"></i> Novo Evento
        </a>
    </div>
</div>

@if($eventos->isEmpty())
    <div class="alert alert-info">Nenhum evento cadastrado.</div>
@else
    <div class="panel-card table-responsive">
        <table class="table table-hover align-middle">
            <thead style="background-color:#1a3a5c; color:#fff;">
                <tr>
                    <th>Título</th>
                    <th>Data</th>
                    <th>Local</th>
                    <th class="text-center">Voluntários</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventos as $evento)
                    <tr>
                        <td>{{ $evento->titulo }}</td>
                        <td>{{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</td>
                        <td>{{ $evento->local ?? 'Não informado' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.eventos.voluntarios', $evento->id) }}" class="badge bg-secondary text-decoration-none">
                                {{ $evento->voluntarios_count }} <i class="bi bi-eye"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.eventos.editar', $evento->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('admin.eventos.excluir', $evento->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Confirmar exclusão?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
