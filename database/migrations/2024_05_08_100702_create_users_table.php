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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("user_name")->unique();
            $table->string("email");
            $table->string("phone_number");
            $table->string("password");
            $table->string("address");
            $table->date("Birth");

            $table->string("image")->default('upload.jpg'); // Set default value for image

            //$table->string("image");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
