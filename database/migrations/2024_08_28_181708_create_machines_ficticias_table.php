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
        Schema::create('machines_ficticias', function (Blueprint $table) {
            $table->id();
            $table->string('maquina_modelo');
            $table->string('nome');
            $table->string('algoritmo');
            $table->integer('uptime'); // Armazenando uptime em minutos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines_ficticias');
    }
};
