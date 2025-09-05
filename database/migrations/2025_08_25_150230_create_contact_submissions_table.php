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
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->integer('submission_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('message')->nullable();
            $table->dateTime('submitted_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
