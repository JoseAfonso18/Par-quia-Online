@extends('layouts.app')

@section('title', 'Editar Aviso')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <h2 class="mb-4"><i class="bi bi-pencil"></i> Editar Aviso</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.avisos.atualizar', $aviso->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $aviso->titulo) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Conteúdo *</label>
                        <textarea name="conteudo" class="form-control" rows="5" required>{{ old('conteudo', $aviso->conteudo) }}</textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="destaque" class="form-check-input" id="destaque"
                            {{ old('destaque', $aviso->destaque) ? 'checked' : '' }}>
                        <label class="form-check-label" for="destaque">Marcar como destaque (aparece na página inicial)</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn text-white" style="background-color:#1a3a5c;">
                            <i class="bi bi-check-circle"></i> Atualizar
                        </button>
                        <a href="{{ route('admin.avisos') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
