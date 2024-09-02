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
        Schema::create('transactions_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('type'); // Exemplo: 'Coin', 'BTC'
            $table->decimal('amount', 16, 8); // O valor da transação em BTC
            $table->text('description')->nullable(); // Descrição opcional da transação
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions_history');
    }
};
