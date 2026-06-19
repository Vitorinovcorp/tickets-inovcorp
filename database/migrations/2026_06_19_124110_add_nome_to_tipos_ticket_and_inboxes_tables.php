<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Adicionar coluna nome na tabela tipos_ticket
        Schema::table('tipos_ticket', function (Blueprint $table) {
            if (!Schema::hasColumn('tipos_ticket', 'nome')) {
                $table->string('nome', 100)->after('id');
            }
        });
        
        // Adicionar coluna nome na tabela inboxes
        Schema::table('inboxes', function (Blueprint $table) {
            if (!Schema::hasColumn('inboxes', 'nome')) {
                $table->string('nome', 100)->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('tipos_ticket', function (Blueprint $table) {
            $table->dropColumn('nome');
        });
        
        Schema::table('inboxes', function (Blueprint $table) {
            $table->dropColumn('nome');
        });
    }
};