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
    Schema::create('user_profiles', function (Blueprint $table) {
        $table->id('profile_id'); // profile table ka apna primary key
        $table->unsignedBigInteger('user_id')->unique();

        // Personal details
        $table->date('dob')->nullable();
        $table->integer('height_cm')->nullable();
        $table->integer('weight_kg')->nullable();
        $table->enum('marital_status', ['Never Married', 'Divorced', 'Widowed', 'Separated'])->nullable();

        // Religion & community
        $table->string('religion', 50)->nullable();
        $table->string('caste', 50)->nullable();
        $table->string('subcaste', 50)->nullable();
        $table->string('gotra', 50)->nullable();
        $table->string('mother_tongue', 50)->nullable();

        // Lifestyle
        $table->enum('diet', ['Veg', 'Non-Veg', 'Eggetarian'])->nullable();
        $table->enum('smoking_habits', ['Never', 'Occasionally', 'Regularly'])->nullable();
        $table->enum('drinking_habits', ['Never', 'Occasionally', 'Regularly'])->nullable();

        // Career
        $table->string('occupation_category', 100)->nullable();
        $table->string('job_title', 100)->nullable();
        $table->string('employer', 100)->nullable();
        $table->string('annual_income', 50)->nullable();

        // Location
        $table->string('native_state', 100)->nullable();
        $table->string('native_district', 100)->nullable();
        $table->string('current_country', 100)->nullable();
        $table->string('current_state', 100)->nullable();
        $table->string('current_city', 100)->nullable();
        $table->string('pin_code', 20)->nullable();

        // Family
        $table->string('father_occupation', 100)->nullable();
        $table->string('mother_occupation', 100)->nullable();
        $table->string('family_status', 50)->nullable();
        $table->integer('siblings')->nullable();
        $table->text('about_family')->nullable();

        // Astrology
        $table->string('rashi', 50)->nullable();
        $table->string('nakshatra', 50)->nullable();
        $table->enum('manglik', ['Yes', 'No'])->nullable();
        $table->time('birth_time')->nullable();
        $table->string('birth_place', 100)->nullable();

        // Extras
        $table->text('hobbies')->nullable();
        $table->boolean('hide_profile')->default(false);
        $table->boolean('watermark_photos')->default(false);

        // Contact
        $table->string('mobile', 20)->nullable();
        $table->string('whatsapp', 20)->nullable();

        $table->timestamps();

        // ✅ Foreign key should reference user_id not id
        $table->foreign('user_id')
              ->references('user_id')
              ->on('users')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
