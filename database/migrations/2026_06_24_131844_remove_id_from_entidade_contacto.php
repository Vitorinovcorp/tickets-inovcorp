<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('entidade_contacto', function (Blueprint $table) {
            // Verificar se a coluna id existe antes de remover
            if (Schema::hasColumn('entidade_contacto', 'id')) {
                $table->dropColumn('id');
            }
        });
    }

    public function down()
    {
        Schema::table('entidade_contacto', function (Blueprint $table) {
            $table->id()->first();
        });
    }
};