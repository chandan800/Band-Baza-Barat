<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shortlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shortlisted_user_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('shortlisted_user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('cascade');

            // Prevent duplicate shortlist entries
            $table->unique(['user_id', 'shortlisted_user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shortlists');
    }
};
