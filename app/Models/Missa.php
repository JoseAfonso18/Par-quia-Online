<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Horário de missa cadastrado pela secretaria (US001 / US014).
 *
 * O campo 'ativo' permite tirar um horário do ar sem excluí-lo,
 * preservando o histórico do cadastro.
 */
class Missa extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia_semana',
        'horario',
        'local',
        'observacao',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    /**
     * Converte o nome do dia da semana no índice usado pelo Carbon
     * (0 = Domingo ... 6 = Sábado).
     *
     * A comparação usa apenas a primeira palavra e ignora acentos, porque o
     * banco convive com as duas grafias já cadastradas ('Sexta feira' e
     * 'Sexta-feira'). Dias não reconhecidos retornam null.
     */
    public static function indiceDia(?string $dia): ?int
    {
        if ($dia === null) {
            return null;
        }

        $mapa = [
            'domingo' => 0,
            'segunda' => 1,
            'terca'   => 2,
            'quarta'  => 3,
            'quinta'  => 4,
            'sexta'   => 5,
            'sabado'  => 6,
        ];

        $texto    = mb_strtolower(trim($dia));
        $texto    = strtr($texto, ['á' => 'a', 'ã' => 'a', 'â' => 'a', 'ç' => 'c', 'é' => 'e', 'ê' => 'e', 'í' => 'i', 'ó' => 'o', 'ô' => 'o', 'ú' => 'u']);
        $primeira = preg_split('/[\s\-]+/', $texto)[0] ?? '';

        return $mapa[$primeira] ?? null;
    }

    /**
     * Retorna todas as missas ordenadas na sequência litúrgica da semana
     * (domingo primeiro) e, dentro do dia, pelo horário.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function listarOrdenadas()
    {
        return static::query()
            ->get()
            ->sortBy(function ($missa) {
                $dia = static::indiceDia($missa->dia_semana) ?? 99;

                return sprintf('%02d-%s', $dia, $missa->horario);
            })
            ->values();
    }

    /**
     * Descobre qual é a próxima missa a acontecer, a partir de agora.
     *
     * Para cada missa ativa calcula quantos dias faltam até a próxima ocorrência
     * do seu dia da semana; se for hoje e o horário já passou, joga para a semana
     * seguinte. Devolve a missa mais próxima com um rótulo pronto para exibição.
     *
     * @return array{missa: \App\Models\Missa, quando: string, horario: string}|null
     */
    public static function proxima(): ?array
    {
        $missas = static::where('ativo', true)->get();

        if ($missas->isEmpty()) {
            return null;
        }

        $agora     = Carbon::now();
        $hojeIdx   = (int) $agora->dayOfWeek;
        $horaAtual = $agora->format('H:i');
        $melhor    = null;

        foreach ($missas as $missa) {
            $indice = static::indiceDia($missa->dia_semana);

            if ($indice === null || empty($missa->horario)) {
                continue;
            }

            $hora   = Carbon::parse($missa->horario)->format('H:i');
            $faltam = ($indice - $hojeIdx + 7) % 7;

            // Missa de hoje cujo horário já passou vale só na próxima semana.
            if ($faltam === 0 && $hora <= $horaAtual) {
                $faltam = 7;
            }

            $peso = $faltam * 10000 + (int) str_replace(':', '', $hora);

            if ($melhor === null || $peso < $melhor['peso']) {
                $melhor = ['peso' => $peso, 'missa' => $missa, 'faltam' => $faltam, 'hora' => $hora];
            }
        }

        if ($melhor === null) {
            return null;
        }

        $quando = match ($melhor['faltam']) {
            0       => 'Hoje',
            1       => 'Amanhã',
            default => ucfirst($melhor['missa']->dia_semana),
        };

        return [
            'missa'   => $melhor['missa'],
            'quando'  => $quando,
            'horario' => $melhor['hora'],
        ];
    }
}
