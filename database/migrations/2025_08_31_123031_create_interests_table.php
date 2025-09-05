<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');  // to whom
            $table->timestamps();

            $table->foreign('sender_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->unique(['sender_id', 'receiver_id']); // prevent duplicate interests
        });
    }

    public function down()
    {
        Schema::dropIfExists('interests');
    }
};
