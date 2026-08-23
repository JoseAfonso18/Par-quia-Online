@extends('layouts.app')

@section('title', 'Voluntários do evento')

@section('content')
<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-hand-thumbs-up"></i></span>
        <div>
            <p class="admin-title">Voluntários · {{ $evento->titulo }}</p>
            <span class="admin-sub">{{ $evento->voluntarios->count() }} pessoa(s) inscrita(s) como voluntária(s)</span>
        </div>
    </div>
    <a href="{{ route('admin.eventos') }}" class="btn btn-sm btn-outline-light">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

@if($evento->voluntarios->isEmpty())
    <div class="alert alert-info">Ainda não há voluntários inscritos neste evento.</div>
@else
    <div class="panel-card table-responsive">
        <table class="table table-hover align-middle">
            <thead style="background-color:#1a3a5c; color:#fff;">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Mensagem</th>
                    <th>Inscrito em</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evento->voluntarios as $i => $u)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->pivot->mensagem ?: '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($u->pivot->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
