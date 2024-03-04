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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status');
            $table->string('description')->nullable();
            $table->string('iamge_path')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('trainer_id');
            $table->timestamps();
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        
            $table->foreign('type_id')->references('id')->on('course_types');
            $table->foreign('trainer_id')->references('id')->on('teachers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
