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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->string('affiliate_code_id', 6); // Ajuste o tamanho conforme necessário
            $table->foreignId('referred_user_id')->constrained('users')->onDelete('cascade');
            $table->string('reffer_status')->nullable();
            $table->string('item_purchased')->nullable();
            $table->timestamps();

            // Corrigir a referência da chave estrangeira
            $table->foreign('affiliate_code_id')->references('codigo_afiliado')->on('afiliados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
