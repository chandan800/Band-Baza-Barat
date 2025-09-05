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
        Schema::create('login_logs', function (Blueprint $table) {
            $table->integer('log_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->string('ip_address', 50)->nullable();
            $table->dateTime('login_time')->nullable()->useCurrent();
            $table->text('device_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }
};
