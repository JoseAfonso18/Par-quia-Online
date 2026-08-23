<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adiciona o campo de imagem em grupos e eventos, para que a secretaria
 * possa ilustrar cada card com uma foto (pedido da paróquia).
 * O campo é opcional: registros sem foto continuam funcionando normalmente.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->string('imagem')->nullable()->after('local');
        });

        Schema::table('eventos', function (Blueprint $table) {
            $table->string('imagem')->nullable()->after('local');
        });
    }

    public function down(): void
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropColumn('imagem');
        });

        Schema::table('eventos', function (Blueprint $table) {
            $table->dropColumn('imagem');
        });
    }
};
