<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Número do ticket (gerado automaticamente)
            if (!Schema::hasColumn('tickets', 'numero_ticket')) {
                $table->string('numero_ticket', 20)->unique()->nullable()->after('id');
            }
            
            // Assunto do ticket
            if (!Schema::hasColumn('tickets', 'assunto')) {
                $table->string('assunto')->after('numero_ticket');
            }
            
            // Tipo do ticket (relacionamento com tipos_ticket)
            if (!Schema::hasColumn('tickets', 'tipo_id')) {
                $table->foreignId('tipo_id')->nullable()->constrained('tipos_ticket')->after('assunto');
            }
            
            // Mensagem do ticket
            if (!Schema::hasColumn('tickets', 'mensagem')) {
                $table->longText('mensagem')->after('tipo_id');
            }
            
            // Estado do ticket (já existe, mas vamos garantir)
            if (!Schema::hasColumn('tickets', 'estado_id')) {
                $table->foreignId('estado_id')->nullable()->constrained('estados')->after('mensagem');
            }
            
            // Operador associado
            if (!Schema::hasColumn('tickets', 'operador_associado_id')) {
                $table->foreignId('operador_associado_id')->nullable()->constrained('users')->after('estado_id');
            }
            
            // Entidade (cliente/empresa)
            if (!Schema::hasColumn('tickets', 'entidade_id')) {
                $table->foreignId('entidade_id')->nullable()->constrained('entidades')->after('operador_associado_id');
            }
            
            // Contacto criador
            if (!Schema::hasColumn('tickets', 'contacto_criador_id')) {
                $table->foreignId('contacto_criador_id')->nullable()->constrained('contactos')->after('entidade_id');
            }
            
            // Inbox (departamento)
            if (!Schema::hasColumn('tickets', 'inbox_id')) {
                $table->foreignId('inbox_id')->nullable()->constrained('inboxes')->after('contacto_criador_id');
            }
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $columns = ['numero_ticket', 'assunto', 'tipo_id', 'mensagem', 'operador_associado_id', 'entidade_id', 'contacto_criador_id', 'inbox_id'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('tickets', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};