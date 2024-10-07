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
        Schema::create('estudantes', function (Blueprint $table) {
            $table->bigInteger('num_matricula')->primary();
            $table->string('nome');
            $table->string('email_estudantil')->unique();
            $table->string('curso');
            $table->string('telefone');
            $table->string('email_responsavel')->nullable('Não informado');
            $table->boolean('is_bolsista')->default(true);
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudantes');
    }
};
