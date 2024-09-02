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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('txId')->unique();
            $table->string('status')->default('in_review'); // Define um valor padrão
            $table->json('description')->nullable();
            $table->string('cpf')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('nome')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
