<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;

/**
 * Área pública de grupos e pastorais: listagem, inscrição e cancelamento
 * (US005 e US007). O CRUD administrativo fica em AdminController.
 */
class GrupoController extends Controller
{
    // US007 - Visualizar grupos da igreja
    public function index()
    {
        $grupos = Grupo::where('ativo', true)->get();

        $gruposInscritos = [];
        if (Auth::check()) {
            $gruposInscritos = Auth::user()->grupos->pluck('id')->toArray();
        }

        return view('grupos.index', compact('grupos', 'gruposInscritos'));
    }

    // US005 - Inscrever-se em um grupo
    public function inscrever($id)
    {
        $grupo = Grupo::findOrFail($id);
        $user  = Auth::user();

        if ($user->is_admin) {
            return back()->with('erro', 'Administradores não podem se inscrever em grupos. Use o painel para visualizar os inscritos.');
        }

        if ($user->grupos()->where('grupo_id', $grupo->id)->exists()) {
            return back()->with('erro', 'Você já está inscrito neste grupo.');
        }

        $user->grupos()->attach($grupo->id);

        return back()->with('sucesso', 'Inscrição confirmada no grupo "' . $grupo->nome . '"!');
    }

    // US005 - Cancelar inscrição em um grupo
    public function cancelar($id)
    {
        $grupo = Grupo::findOrFail($id);
        Auth::user()->grupos()->detach($grupo->id);

        return back()->with('sucesso', 'Inscrição cancelada no grupo "' . $grupo->nome . '".');
    }
}
