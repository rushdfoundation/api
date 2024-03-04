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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('grand_father_name');
            $table->dateTime('dob');
            $table->dateTime('doj');
            $table->string('gender');
            $table->string('tazikra_number');
            $table->string('tazikra_photo_url')->nullable();
            $table->string('marital_status')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('guardian_refrence_id');
            $table->timestamps();
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
