@extends('layouts.app')

@section('title', 'Horários de Missas')

@section('content')
@php
    $hojeIdx = (int) now()->dayOfWeek;
@endphp

<div class="admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="admin-logo"><i class="bi bi-clock"></i></span>
        <div>
            <p class="admin-title">Horários de missas</p>
            <span class="admin-sub">Confira as celebrações da semana na nossa paróquia</span>
        </div>
    </div>
</div>

@if($missas->isEmpty())
    <div class="alert alert-info">Nenhum horário cadastrado no momento.</div>
@else
    {{-- Próxima missa em destaque --}}
    @if($proximaMissa)
        <div class="prox-missa d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="rotulo">Próxima missa</div>
                <div class="valor">{{ $proximaMissa['quando'] }}, às {{ $proximaMissa['horario'] }}</div>
                <div class="detalhe">
                    <i class="bi bi-geo-alt"></i> {{ $proximaMissa['missa']->local ?? 'Igreja Matriz' }}
                    @if($proximaMissa['missa']->observacao)
                        · {{ $proximaMissa['missa']->observacao }}
                    @endif
                </div>
            </div>
            <a href="https://www.google.com/maps/dir/?api=1&destination=Par%C3%B3quia+Nossa+Senhora+da+Gl%C3%B3ria%2C+Pitanga+-+PR"
               target="_blank" rel="noopener" class="btn btn-outline-light">
                <i class="bi bi-map"></i> Como chegar
            </a>
        </div>
    @endif

    {{-- Tabela completa da semana --}}
    <div class="panel-card table-responsive">
        <table class="table table-hover align-middle">
            <thead style="background-color:#1a3a5c; color:#fff;">
                <tr>
                    <th style="width:28%">Dia da semana</th>
                    <th style="width:16%">Horário</th>
                    <th style="width:28%">Local</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                @php $diaAnterior = null; @endphp
                @foreach($missas as $missa)
                    @php
                        $idx        = \App\Models\Missa::indiceDia($missa->dia_semana);
                        $mesmoDia   = ($diaAnterior === $missa->dia_semana);
                        $diaAnterior = $missa->dia_semana;
                    @endphp
                    <tr @if($idx === 0) style="background-color:#fffaf0;"
                        @elseif($idx === $hojeIdx) style="background-color:#eef5fb;" @endif>
                        <td>
                            @if(! $mesmoDia)
                                <strong style="color:#1a3a5c;">{{ $missa->dia_semana }}</strong>
                                @if($idx === $hojeIdx)
                                    <span class="badge" style="background-color:#1a3a5c;">hoje</span>
                                @elseif($idx === 0)
                                    <span class="badge" style="background-color:#fdecc8; color:#8a5a00;">principal</span>
                                @endif
                            @endif
                        </td>
                        <td><strong style="color:#1a3a5c;">{{ \Carbon\Carbon::parse($missa->horario)->format('H:i') }}</strong></td>
                        <td>{{ $missa->local ?? 'Igreja Matriz' }}</td>
                        <td class="text-muted">{{ $missa->observacao ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <p class="small text-muted mt-3 mb-0">
        <i class="bi bi-info-circle"></i>
        Os horários podem sofrer alterações em datas especiais e festas da paróquia.
    </p>
@endif
@endsection
