<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // ==========================================
        // 1. CORRIGIR TABELA ticket_conhecimento
        // ==========================================
        if (Schema::hasTable('ticket_conhecimento')) {
            // Adicionar ticket_id se não existir
            if (!Schema::hasColumn('ticket_conhecimento', 'ticket_id')) {
                Schema::table('ticket_conhecimento', function (Blueprint $table) {
                    $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade')->after('id');
                });
            }
            // Adicionar email se não existir
            if (!Schema::hasColumn('ticket_conhecimento', 'email')) {
                Schema::table('ticket_conhecimento', function (Blueprint $table) {
                    $table->string('email')->after('ticket_id');
                });
            }
        }

        // ==========================================
        // 2. CORRIGIR TABELA atividade_tickets
        // ==========================================
        if (Schema::hasTable('atividade_tickets')) {
            // Adicionar ticket_id se não existir
            if (!Schema::hasColumn('atividade_tickets', 'ticket_id')) {
                Schema::table('atividade_tickets', function (Blueprint $table) {
                    $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade')->after('id');
                });
            }
            // Adicionar acao se não existir
            if (!Schema::hasColumn('atividade_tickets', 'acao')) {
                Schema::table('atividade_tickets', function (Blueprint $table) {
                    $table->string('acao')->after('ticket_id');
                });
            }
            // Adicionar dados_antigos se não existir
            if (!Schema::hasColumn('atividade_tickets', 'dados_antigos')) {
                Schema::table('atividade_tickets', function (Blueprint $table) {
                    $table->json('dados_antigos')->nullable()->after('acao');
                });
            }
            // Adicionar dados_novos se não existir
            if (!Schema::hasColumn('atividade_tickets', 'dados_novos')) {
                Schema::table('atividade_tickets', function (Blueprint $table) {
                    $table->json('dados_novos')->nullable()->after('dados_antigos');
                });
            }
            // Adicionar user_id se não existir
            if (!Schema::hasColumn('atividade_tickets', 'user_id')) {
                Schema::table('atividade_tickets', function (Blueprint $table) {
                    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('dados_novos');
                });
            }
        }

        // ==========================================
        // 3. CORRIGIR TABELA respostas
        // ==========================================
        if (Schema::hasTable('respostas')) {
            // Adicionar ticket_id se não existir
            if (!Schema::hasColumn('respostas', 'ticket_id')) {
                Schema::table('respostas', function (Blueprint $table) {
                    $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade')->after('id');
                });
            }
            // Adicionar user_id se não existir
            if (!Schema::hasColumn('respostas', 'user_id')) {
                Schema::table('respostas', function (Blueprint $table) {
                    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('ticket_id');
                });
            }
            // Adicionar contacto_id se não existir
            if (!Schema::hasColumn('respostas', 'contacto_id')) {
                Schema::table('respostas', function (Blueprint $table) {
                    $table->foreignId('contacto_id')->nullable()->constrained('contactos')->onDelete('set null')->after('user_id');
                });
            }
            // Adicionar mensagem se não existir
            if (!Schema::hasColumn('respostas', 'mensagem')) {
                Schema::table('respostas', function (Blueprint $table) {
                    $table->longText('mensagem')->after('contacto_id');
                });
            }
        }

        echo "✅ Todas as tabelas foram corrigidas!\n";
    }

    public function down()
    {
        // Não é necessário reverter
    }
};
