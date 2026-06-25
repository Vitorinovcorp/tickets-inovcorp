<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Verificar se a tabela existe
        if (Schema::hasTable('ticket_conhecimento')) {
            
            // Verificar se a coluna ticket_id existe
            if (!Schema::hasColumn('ticket_conhecimento', 'ticket_id')) {
                
                // Adicionar a coluna ticket_id
                Schema::table('ticket_conhecimento', function (Blueprint $table) {
                    $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade')->after('id');
                });
            }
            
            // Verificar se a coluna email existe
            if (!Schema::hasColumn('ticket_conhecimento', 'email')) {
                Schema::table('ticket_conhecimento', function (Blueprint $table) {
                    $table->string('email')->after('ticket_id');
                });
            }
        } else {
            // Se a tabela não existir, criar
            Schema::create('ticket_conhecimento', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
                $table->string('email');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::table('ticket_conhecimento', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
            $table->dropColumn('ticket_id');
            $table->dropColumn('email');
        });
    }
};