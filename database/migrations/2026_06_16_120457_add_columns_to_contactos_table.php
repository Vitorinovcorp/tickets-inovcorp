<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contactos', function (Blueprint $table) {
            if (!Schema::hasColumn('contactos', 'nome')) {
                $table->string('nome')->after('id');
            }
            if (!Schema::hasColumn('contactos', 'funcao_id')) {
                $table->foreignId('funcao_id')->nullable()->constrained('funcoes')->after('nome');
            }
            if (!Schema::hasColumn('contactos', 'email')) {
                $table->string('email')->unique()->after('funcao_id');
            }
            if (!Schema::hasColumn('contactos', 'password')) {
                $table->string('password')->nullable()->after('email');
            }
            if (!Schema::hasColumn('contactos', 'telefone')) {
                $table->string('telefone', 20)->nullable()->after('password');
            }
            if (!Schema::hasColumn('contactos', 'telemovel')) {
                $table->string('telemovel', 20)->nullable()->after('telefone');
            }
            if (!Schema::hasColumn('contactos', 'notas_internas')) {
                $table->text('notas_internas')->nullable()->after('telemovel');
            }
        });
    }

    public function down()
    {
        Schema::table('contactos', function (Blueprint $table) {
            $table->dropColumn(['nome', 'funcao_id', 'email', 'password', 'telefone', 'telemovel', 'notas_internas']);
        });
    }
};