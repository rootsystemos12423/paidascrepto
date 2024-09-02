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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unique()->onDelete('cascade');
            $table->decimal('balance_brl', 16, 2)->default(0); // Saldo em BRL
            $table->decimal('balance_btc', 16, 8)->default(0); // Saldo em BTC
            $table->decimal('balance_alph', 16, 8)->default(0); // Saldo em ALPH
            $table->decimal('balance_kaspa', 16, 8)->default(0); // Saldo em KASPA
            $table->decimal('balance_ltc', 16, 8)->default(0); // Saldo em LTC
            $table->timestamps();
        });        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
