<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 16, 8);
            $table->string('status');
            $table->dateTime('requested_at');
            $table->dateTime('processed_at')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('method');
            $table->text('details')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Caso você tenha uma tabela de transações e queira ligar, descomente a linha abaixo

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}

