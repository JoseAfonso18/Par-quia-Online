<?php

/**
 * Dados de contato da paróquia usados nas páginas públicas.
 * O número do WhatsApp fica no .env para poder ser trocado sem alterar código.
 */
return [
    'whatsapp' => env('PAROQUIA_WHATSAPP', '5542998204618'),
    'telefone' => env('PAROQUIA_TELEFONE', '(42) 3746-1336'),
];
