<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Evento ou festa do calendário paroquial (US002 / US006).
 */
class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data',
        'horario',
        'local',
        'imagem',
    ];

    protected $casts = [
        'data' => 'date',
    ];

    /**
     * Usuários inscritos como voluntários neste evento (US008).
     *
     * Relacionamento N:N pela pivô 'voluntarios', incluindo a coluna extra
     * 'mensagem' para que o painel administrativo exiba o recado do voluntário.
     */
    public function voluntarios()
    {
        return $this->belongsToMany(User::class, 'voluntarios')
                    ->withPivot('mensagem')
                    ->withTimestamps();
    }
}
