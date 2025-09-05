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
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('admin_id', true);
            $table->string('username', 100)->nullable()->unique('username');
            $table->string('password_hash')->nullable();
            $table->enum('role', ['superadmin', 'moderator', 'support'])->nullable()->default('moderator');
            $table->dateTime('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
