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
        Schema::create('user_photos', function (Blueprint $table) {
            $table->integer('photo_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->string('photo_url')->nullable();
            $table->boolean('is_profile_photo')->nullable()->default(false);
            $table->boolean('is_verified')->nullable()->default(false);
            $table->dateTime('uploaded_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_photos');
    }
};
