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
        Schema::create('transactions_info', function (Blueprint $table) {
            $table->id();
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('transaction_key')->references('transaction_key')->on('transactions');
            $table->string('beneficiary');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->float('amount', 4);
            $table->string('description');
            $table->boolean('immediate');
            $table->timestamp('process_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_infos');
    }
};
