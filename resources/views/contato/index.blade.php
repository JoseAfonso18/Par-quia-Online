@extends('layouts.app')

@section('title', 'Contato')

@section('content')
<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-chat-dots"></i></span>
        <div>
            <p class="admin-title">Fale conosco</p>
            <span class="admin-sub">Estamos à disposição para tirar suas dúvidas</span>
        </div>
    </div>
</div>

{{-- WhatsApp em destaque: caminho mais rápido de contato --}}
<div class="card shadow-sm mb-4" style="background-color:#eafaf0; border:1px solid #b9e7cb;">
    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center gap-3">
            <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                  style="width:52px; height:52px; border-radius:50%; background-color:#25d366; color:#fff; font-size:1.6rem;">
                <i class="bi bi-whatsapp"></i>
            </span>
            <div>
                <h5 class="mb-1" style="color:#0a3d1f;">Fale com a secretaria pelo WhatsApp</h5>
                <p class="mb-0 small" style="color:#2f6b3b;">
                    É o jeito mais rápido de falar conosco. A conversa abre com a mensagem pronta.
                </p>
            </div>
        </div>
        <x-whatsapp-btn
            mensagem="Olá, vim pelo site da paróquia e gostaria de falar com a secretaria."
            rotulo="Abrir conversa"
            classe="btn btn-whats btn-lg" />
    </div>
</div>

{{-- Informações de contato --}}
<div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
    <div class="col">
        <div class="card h-100 shadow-sm" style="border-left:4px solid #cdd6df;">
            <div class="card-body">
                <h6 class="mb-1" style="color:#1a3a5c;"><i class="bi bi-telephone"></i> Telefone</h6>
                <p class="small text-muted mb-0">{{ config('paroquia.telefone') }}</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100 shadow-sm" style="border-left:4px solid #cdd6df;">
            <div class="card-body">
                <h6 class="mb-1" style="color:#1a3a5c;"><i class="bi bi-clock"></i> Atendimento</h6>
                <p class="small text-muted mb-0">Segunda a sexta<br>09h às 12h e 14h às 17h</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100 shadow-sm" style="border-left:4px solid #cdd6df;">
            <div class="card-body">
                <h6 class="mb-1" style="color:#1a3a5c;"><i class="bi bi-geo-alt"></i> Endereço</h6>
                <p class="small text-muted mb-0">Caixa Postal, 10<br>85200-000, Pitanga/PR</p>
            </div>
        </div>
    </div>
</div>

{{-- US012 / US015 - Formulário de contato por e-mail (alternativa ao WhatsApp) --}}
<div class="row justify-content-center">
    <div class="col-lg-8">
        <h5 class="mb-3" style="color:#1a3a5c;">
            <i class="bi bi-envelope"></i> Prefere escrever? Envie uma mensagem
        </h5>

        <div class="card shadow-sm">
            <div class="card-body">

                @if(session('sucesso'))
                    <div class="alert alert-success">{{ session('sucesso') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contato.enviar') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                                value="{{ old('nome') }}" placeholder="Seu nome completo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="seuemail@exemplo.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Assunto</label>
                        <input type="text" name="assunto" class="form-control @error('assunto') is-invalid @enderror"
                            value="{{ old('assunto') }}" placeholder="Assunto da mensagem" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mensagem</label>
                        <textarea name="mensagem" class="form-control @error('mensagem') is-invalid @enderror"
                            rows="5" placeholder="Escreva sua mensagem..." required>{{ old('mensagem') }}</textarea>
                    </div>

                    <button type="submit" class="btn w-100 text-white" style="background-color: #1a3a5c;">
                        <i class="bi bi-send"></i> Enviar mensagem
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
