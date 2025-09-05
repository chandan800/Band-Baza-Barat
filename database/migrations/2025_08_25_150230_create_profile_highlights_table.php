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
        Schema::create('profile_highlights', function (Blueprint $table) {
            $table->integer('highlight_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->enum('type', ['highlight', 'premium', 'advisor'])->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_highlights');
    }
};
