<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

/**
 * Listagem pública dos eventos e festas da comunidade (US002).
 */
class EventoController extends Controller
{
    // US002 - Listar eventos e festas da comunidade
    public function index()
    {
        $eventos = Evento::orderBy('data', 'asc')->get();

        return view('eventos.index', compact('eventos'));
    }
}
