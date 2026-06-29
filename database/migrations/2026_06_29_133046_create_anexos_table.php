<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anexos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->foreignId('resposta_id')->nullable()->constrained('respostas')->onDelete('cascade');
            $table->string('nome_original');
            $table->string('nome_arquivo');
            $table->string('caminho');
            $table->string('mime_type');
            $table->bigInteger('tamanho');
            $table->string('extensao', 10);
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anexos');
    }
};