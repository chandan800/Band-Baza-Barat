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
        Schema::create('search_preferences', function (Blueprint $table) {
            $table->integer('pref_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->enum('looking_for', ['Bride', 'Groom'])->nullable();
            $table->integer('age_min')->nullable();
            $table->integer('age_max')->nullable();
            $table->string('community', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_preferences');
    }
};
