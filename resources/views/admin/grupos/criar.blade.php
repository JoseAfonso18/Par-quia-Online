@extends('layouts.app')

@section('title', 'Novo Grupo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0"><i class="bi bi-plus-circle"></i> Novo Grupo</h2>
    <a href="{{ route('admin.grupos') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.grupos.salvar') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nome do grupo *</label>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                       value="{{ old('nome') }}" required>
                @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição *</label>
                <textarea name="descricao" rows="3" class="form-control @error('descricao') is-invalid @enderror"
                          required>{{ old('descricao') }}</textarea>
                @error('descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Responsável</label>
                    <input type="text" name="responsavel" class="form-control" value="{{ old('responsavel') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Local</label>
                    <input type="text" name="local" class="form-control" value="{{ old('local') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Dia da reunião</label>
                    <select name="dia_reuniao" class="form-select">
                        <option value="">Selecione...</option>
                        @foreach(['Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado','Domingo'] as $d)
                            <option value="{{ $d }}" {{ old('dia_reuniao') === $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Horário</label>
                    <input type="time" name="horario_reuniao" class="form-control @error('horario_reuniao') is-invalid @enderror"
                           value="{{ old('horario_reuniao') }}">
                    @error('horario_reuniao')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="bi bi-image"></i> Foto do grupo
                    <span class="text-muted fw-normal">(opcional)</span>
                </label>
                <input type="file" name="imagem" accept="image/*"
                       class="form-control @error('imagem') is-invalid @enderror">
                @error('imagem')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text">
                    JPG, PNG ou WEBP, até 2 MB. A foto aparece no card do grupo na página pública.
                </div>
            </div>

            <button type="submit" class="btn text-white" style="background-color:#1a3a5c;">
                <i class="bi bi-save"></i> Salvar Grupo
            </button>
        </form>
    </div>
</div>
@endsection
