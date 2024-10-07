<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rendimentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_estudante');
            $table->float('rendimento_academico');
            $table->float('frequencia_escolar');
            $table->float('ira_curso');
            $table->timestamps();
            $table->foreign('id_estudante')->references('num_matricula')->on('estudantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendimentos');
    }
};
