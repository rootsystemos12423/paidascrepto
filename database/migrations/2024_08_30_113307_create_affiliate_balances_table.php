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
        Schema::create('affiliate_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Coluna para o ID do usuário
            $table->decimal('balance_brl', 16, 2)->default(0); // Saldo em BRL
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_balances');
    }
};
