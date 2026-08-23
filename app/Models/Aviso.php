<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Aviso paroquial publicado pela secretaria (US010).
 *
 * Avisos marcados como 'destaque' são exibidos na página inicial;
 * todos aparecem na página /avisos.
 */
class Aviso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'conteudo',
        'destaque',
    ];

    protected $casts = [
        'destaque' => 'boolean',
    ];
}
