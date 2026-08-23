<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grupo;

class GrupoSeeder extends Seeder
{
    public function run(): void
    {
        $grupos = [
            [
                'nome'            => 'Grupo de Jovens',
                'descricao'       => 'Grupo voltado para jovens da comunidade com encontros de fé, reflexão e convivência.',
                'responsavel'     => 'Pe. Ivan',
                'dia_reuniao'     => 'Sábado',
                'horario_reuniao' => '19:00',
                'local'           => 'Salão Paroquial',
            ],
            [
                'nome'            => 'Grupo de Dança Ucraniana',
                'descricao'       => 'Preservação da cultura ucraniana através da dança tradicional. Aberto para todas as idades.',
                'responsavel'     => 'Olena Petrenko',
                'dia_reuniao'     => 'Quarta feira',
                'horario_reuniao' => '19:30',
                'local'           => 'Salão Paroquial',
            ],
            [
                'nome'            => 'Catequese',
                'descricao'       => 'Formação religiosa para crianças e adolescentes que desejam receber os sacramentos.',
                'responsavel'     => 'Marta Kovalenko',
                'dia_reuniao'     => 'Sábado',
                'horario_reuniao' => '14:00',
                'local'           => 'Sala de Catequese',
            ],
            [
                'nome'            => 'Apostolado da Oração',
                'descricao'       => 'Grupo de oração e espiritualidade com terço, leituras bíblicas e partilha da fé.',
                'responsavel'     => 'Maria Bondarenko',
                'dia_reuniao'     => 'Domingo',
                'horario_reuniao' => '08:30',
                'local'           => 'Igreja Matriz',
            ],
        ];

        foreach ($grupos as $grupo) {
            Grupo::firstOrCreate(
                ['nome' => $grupo['nome']],
                array_merge($grupo, ['ativo' => true])
            );
        }
    }
}
