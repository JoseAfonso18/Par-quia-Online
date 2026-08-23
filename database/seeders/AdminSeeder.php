<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Cria (ou atualiza) o usuário administrador da paróquia.
 *
 * As credenciais vêm do .env, que não é versionado — assim a senha real
 * usada pela secretaria nunca fica exposta no repositório. Um projeto
 * recém-clonado usa o valor de exemplo do .env.example, que deve ser
 * trocado antes de colocar o sistema no ar.
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@paroquia.com');
        $senha = env('ADMIN_SENHA', 'trocar-esta-senha');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => 'Administrador',
                'password' => Hash::make($senha),
                'is_admin' => true,
            ]
        );
    }
}
