<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('entidade_contacto', function (Blueprint $table) {
            if (!Schema::hasColumn('entidade_contacto', 'entidade_id')) {
                $table->foreignId('entidade_id')->constrained('entidades')->onDelete('cascade')->after('id');
            }
            if (!Schema::hasColumn('entidade_contacto', 'contacto_id')) {
                $table->foreignId('contacto_id')->constrained('contactos')->onDelete('cascade')->after('entidade_id');
            }
        });
    }

    public function down()
    {
        Schema::table('entidade_contacto', function (Blueprint $table) {
            $table->dropForeign(['entidade_id']);
            $table->dropForeign(['contacto_id']);
            $table->dropColumn(['entidade_id', 'contacto_id']);
        });
    }
};