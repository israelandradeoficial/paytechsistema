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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('slug')->unique();
            $table->string('cpf_cnpj')->unique();
            $table->string('nascimento')->nullable();
            $table->string('email')->unique();
            $table->string('telefone');
            $table->string('cep');
            $table->string('rua');
            $table->string('bairro');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('cidade');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
