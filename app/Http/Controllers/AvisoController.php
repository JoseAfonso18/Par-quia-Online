<?php

namespace App\Http\Controllers;

use App\Models\Aviso;

/**
 * Listagem pública dos avisos paroquiais, do mais recente ao mais antigo (US010).
 */
class AvisoController extends Controller
{
    public function index()
    {
        $avisos = Aviso::latest()->get();
        return view('avisos.index', compact('avisos'));
    }
}
