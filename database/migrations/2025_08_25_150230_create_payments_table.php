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
        Schema::create('payments', function (Blueprint $table) {
            $table->integer('payment_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->integer('plan_id')->nullable()->index('plan_id');
            $table->decimal('amount_paid', 10)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->enum('payment_status', ['success', 'failed', 'pending'])->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->dateTime('paid_at')->nullable()->useCurrent();
            $table->date('valid_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
