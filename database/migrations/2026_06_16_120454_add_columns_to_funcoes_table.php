<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('funcoes', function (Blueprint $table) {
            if (!Schema::hasColumn('funcoes', 'nome')) {
                $table->string('nome', 100)->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('funcoes', function (Blueprint $table) {
            $table->dropColumn('nome');
        });
    }
};