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
        Schema::create('matches', function (Blueprint $table) {
            $table->integer('connection_id', true);
            $table->integer('from_user_id')->nullable()->index('from_user_id');
            $table->integer('to_user_id')->nullable()->index('to_user_id');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'blocked'])->nullable();
            $table->dateTime('initiated_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
