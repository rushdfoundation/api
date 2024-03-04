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
        Schema::create('homework_question', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homework_id');
            $table->unsignedBigInteger('question_id');
            $table->timestamps();

            $table->foreign('homework_id')->references('id')->on('homeworks');
            $table->foreign('question_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework_question');
    }
};
