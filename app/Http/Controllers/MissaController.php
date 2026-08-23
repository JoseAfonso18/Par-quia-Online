<?php

namespace App\Http\Controllers;

use App\Models\Missa;
use Illuminate\Http\Request;

/**
 * Listagem pública dos horários de missas (US001).
 *
 * Exibe apenas missas ativas, ordenadas de domingo a sábado — a ordenação
 * é feita em PHP porque o dia da semana é gravado como texto no banco.
 */
class MissaController extends Controller
{
    // US001 - Exibir horários de missas
    public function index()
    {
        // A ordenação por dia da semana e horário fica no model, que reconhece
        // as duas grafias já existentes no banco ('Sexta feira' e 'Sexta-feira').
        $missas = Missa::listarOrdenadas()->where('ativo', true)->values();

        $proximaMissa = Missa::proxima();

        return view('missas.index', compact('missas', 'proximaMissa'));
    }
}
