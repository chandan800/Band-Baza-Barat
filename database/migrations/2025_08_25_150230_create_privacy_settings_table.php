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
        Schema::create('privacy_settings', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->enum('show_photo_to', ['all', 'matches_only', 'none'])->nullable()->default('all');
            $table->enum('show_contact_to', ['premium_only', 'all', 'none'])->nullable()->default('premium_only');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_settings');
    }
};
