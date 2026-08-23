<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Usuário do sistema — abrange tanto os fiéis cadastrados pelo site
 * quanto os administradores da secretaria (distinguidos pelo campo is_admin).
 *
 * Estende Authenticatable para se integrar ao guard 'web' do Laravel.
 */
class User extends Authenticatable
{
    use HasFactory;

    /**
     * Campos liberados para atribuição em massa (User::create / update).
     * Qualquer outro campo enviado no request é ignorado — proteção contra mass assignment.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * Campos nunca expostos ao serializar o model (JSON, logs, views).
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Conversões automáticas de tipo ao ler/gravar no banco.
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    /**
     * Grupos e pastorais em que o usuário está inscrito (US005/US007).
     *
     * Relacionamento N:N pela tabela pivô 'inscricoes_grupo'; withTimestamps()
     * grava created_at/updated_at na pivô, registrando a data da inscrição.
     */
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'inscricoes_grupo')
                    ->withTimestamps();
    }

    /**
     * Eventos em que o usuário se candidatou a voluntário (US008).
     *
     * Relacionamento N:N pela tabela pivô 'voluntarios'. O campo extra 'mensagem'
     * guarda o recado opcional deixado pelo voluntário no momento da candidatura.
     */
    public function eventosVoluntario()
    {
        return $this->belongsToMany(Evento::class, 'voluntarios')
                    ->withPivot('mensagem')
                    ->withTimestamps();
    }
}
