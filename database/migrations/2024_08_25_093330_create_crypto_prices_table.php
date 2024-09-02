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
        Schema::create('crypto_prices', function (Blueprint $table) {
            $table->id();
            $table->string('crypto_symbol'); // Símbolo da cripto (ex: BTC, KAS, ALPH)
            $table->decimal('price_in_brl', 20, 8); // Preço atual em BRL
            $table->text('display_price'); // Preço atual em BRL
            $table->decimal('change_pct_24h', 10, 4)->nullable(); // Variação percentual em 24 horas
            $table->decimal('high_24h', 20, 8)->nullable(); // Alta nas últimas 24h
            $table->decimal('low_24h', 20, 8)->nullable(); // Baixa nas últimas 24h
            $table->decimal('volume_24h', 20, 8)->nullable(); // Volume negociado nas últimas 24h
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_prices');
    }
};
