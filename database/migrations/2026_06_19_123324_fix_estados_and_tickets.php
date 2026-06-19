<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Remover a foreign key da tabela tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);
            $table->dropColumn('estado_id');
        });

        // 2. Dropar a tabela estados
        Schema::dropIfExists('estados');

        // 3. Recriar a tabela estados com a estrutura correta
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('cor', 20)->default('#gray');
            $table->timestamps();
        });

        // 4. Inserir os estados padrão
        DB::table('estados')->insert([
            ['nome' => 'Aberto', 'cor' => '#e74c3c', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Em Tratamento', 'cor' => '#f39c12', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Fechado', 'cor' => '#27ae60', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 5. Adicionar a foreign key novamente
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('estado_id')->nullable()->constrained('estados')->after('tipo_id');
        });
    }

    public function down()
    {
        // Reverter as alterações
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);
            $table->dropColumn('estado_id');
        });

        Schema::dropIfExists('estados');
    }
};