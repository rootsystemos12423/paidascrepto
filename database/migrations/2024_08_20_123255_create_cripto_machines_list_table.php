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
        Schema::create('cripto_machines_list', function (Blueprint $table) {
            $table->id(); // Adiciona uma coluna auto-incremental ID
            $table->string('Name'); // Nome da máquina
            $table->decimal('value', 10, 2); // Valor da máquina, com 10 dígitos no total e 2 casas decimais
            $table->string('Algorithm'); // Algoritmo usado pela máquina
            $table->decimal('hashrate', 15, 2); // Hashrate da máquina, com 15 dígitos no total e 2 casas decimais
            $table->enum('hashrate_type', ['GH', 'TH', 'MH']); // Tipo de hashrate
            $table->decimal('mining_profit', 10, 2); // Lucro de mineração, com 10 dígitos no total e 2 casas decimais
            $table->text('machine_endpoint');
            $table->timestamps(); // Adiciona as colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cripto_machines_list');
    }
};
