<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('entidades', function (Blueprint $table) {
            if (!Schema::hasColumn('entidades', 'nif')) {
                $table->string('nif', 20)->unique()->after('id');
            }
            if (!Schema::hasColumn('entidades', 'nome')) {
                $table->string('nome')->after('nif');
            }
            if (!Schema::hasColumn('entidades', 'telefone')) {
                $table->string('telefone', 20)->nullable()->after('nome');
            }
            if (!Schema::hasColumn('entidades', 'telemovel')) {
                $table->string('telemovel', 20)->nullable()->after('telefone');
            }
            if (!Schema::hasColumn('entidades', 'website')) {
                $table->string('website')->nullable()->after('telemovel');
            }
            if (!Schema::hasColumn('entidades', 'email')) {
                $table->string('email')->nullable()->after('website');
            }
            if (!Schema::hasColumn('entidades', 'notas_internas')) {
                $table->text('notas_internas')->nullable()->after('email');
            }
        });
    }

    public function down()
    {
        Schema::table('entidades', function (Blueprint $table) {
            $table->dropColumn(['nif', 'nome', 'telefone', 'telemovel', 'website', 'email', 'notas_internas']);
        });
    }
};