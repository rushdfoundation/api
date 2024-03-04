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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('province');
            $table->string('city');
            $table->string('district')->nullable();
            $table->string('street')->nullable();
            $table->string('street_number')->nullable();
            $table->string('lane')->nullable();
            $table->string('house')->nullable();
            $table->string('zip')->nullable();
            $table->string('formatted_address');
            $table->timestamps();
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
