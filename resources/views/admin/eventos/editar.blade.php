@extends('layouts.app')

@section('title', 'Editar Evento')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <h2 class="mb-4"><i class="bi bi-pencil"></i> Editar Evento</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.eventos.atualizar', $evento->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" name="titulo" class="form-control"
                            value="{{ old('titulo', $evento->titulo) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição *</label>
                        <textarea name="descricao" class="form-control" rows="4" required>{{ old('descricao', $evento->descricao) }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Data *</label>
                            <input type="date" name="data" class="form-control"
                                value="{{ old('data', $evento->data->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Horário</label>
                            <input type="time" name="horario" class="form-control"
                                value="{{ old('horario', $evento->horario ? \Carbon\Carbon::parse($evento->horario)->format('H:i') : '') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Local</label>
                        <input type="text" name="local" class="form-control"
                            value="{{ old('local', $evento->local) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-image"></i> Foto do evento
                            <span class="text-muted fw-normal">(opcional)</span>
                        </label>

                        @if($evento->imagem)
                            <div class="mb-2 d-flex align-items-center gap-3">
                                <img src="{{ asset($evento->imagem) }}" alt="Foto atual do evento"
                                     style="width:150px; height:95px; object-fit:cover; border-radius:8px; border:1px solid #e3e8ee;">
                                <div class="form-check">
                                    <input type="checkbox" name="remover_imagem" value="1" class="form-check-input" id="remover_imagem">
                                    <label class="form-check-label small" for="remover_imagem">Remover a foto atual</label>
                                </div>
                            </div>
                        @endif

                        <input type="file" name="imagem" accept="image/*"
                               class="form-control @error('imagem') is-invalid @enderror">
                        @error('imagem')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">
                            JPG, PNG ou WEBP, até 2 MB. Enviar uma nova foto substitui a atual.
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn text-white" style="background-color:#1a3a5c;">
                            <i class="bi bi-check-circle"></i> Atualizar
                        </button>
                        <a href="{{ route('admin.eventos') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
