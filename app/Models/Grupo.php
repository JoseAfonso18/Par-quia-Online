<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Grupo ou pastoral da paróquia (US007 / US013).
 *
 * O campo 'ativo' controla a exibição pública sem apagar o registro
 * nem as inscrições já realizadas.
 */
class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'responsavel',
        'dia_reuniao',
        'horario_reuniao',
        'local',
        'imagem',
        'ativo',
    ];

    /**
     * Fiéis inscritos no grupo (US005).
     *
     * Relacionamento N:N pela pivô 'inscricoes_grupo'; os timestamps da pivô
     * permitem saber quando cada inscrição foi feita.
     */
    public function inscritos()
    {
        return $this->belongsToMany(User::class, 'inscricoes_grupo')
                    ->withTimestamps();
    }
}
