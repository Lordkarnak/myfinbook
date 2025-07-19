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
            $table->unsignedBigInteger('transaction_id');
            $table->string('transaction_key', 80);
            $table->string('beneficiary');
            $table->unsignedBigInteger('currency_id');
            $table->float('amount', 4);
            $table->string('description')->nullable();
            $table->boolean('immediate')->default(false);
            $table->timestamp('process_date')->default(now())->index();
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('transaction_key')->references('transaction_key')->on('transactions');
            $table->foreign('transaction_key', 'transactions_info_subtransaction_key_foreign')->references('subtransaction_key')->on('transactions');
            $table->foreign('currency_id')->references('id')->on('currencies');
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
