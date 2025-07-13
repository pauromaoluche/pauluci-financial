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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('sender_account_number');
            $table->string('recipient_account_number');
            $table->foreignId('type_transaction_id')->constrained();
            $table->decimal('amount', 15, 2);
            $table->foreignId('status_transaction_id')->constrained();
            $table->text('description')->nullable();
            $table->text('error_message')->nullable();
            $table->uuid('batch_id')->nullable();
            $table->timestamps();

            $table->foreign('recipient_account_number')
                ->references('account_number')
                ->on('accounts');
            $table->foreign('sender_account_number')
                ->references('account_number')
                ->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
