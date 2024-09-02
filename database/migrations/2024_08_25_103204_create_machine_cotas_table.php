<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('machine_cotas', function (Blueprint $table) {
            $table->id(); // Adiciona uma coluna 'id' auto-incrementável como chave primária
            $table->unsignedBigInteger('machine_id'); // Coluna para o ID da máquina
            $table->decimal('hashrate', 15, 2); // Hashrate da máquina, com 15 dígitos no total e 2 casas decimais
            $table->enum('hashrate_type', ['GH', 'TH', 'MH']); // Tipo de hashrate
            $table->unsignedBigInteger('user_id'); // Coluna para o ID do usuário
            $table->timestamps(); // Adiciona as colunas 'created_at' e 'updated_at'

            // Adiciona chaves estrangeiras, se necessário
            $table->foreign('machine_id')->references('id')->on('cripto_machines_list')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_cotas');
    }
};
