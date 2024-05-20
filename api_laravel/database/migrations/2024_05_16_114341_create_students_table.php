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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->json('alternate_names');
            $table->string('species');
            $table->string('gender');
            $table->string('house')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->integer('yearOfBirth')->nullable();
            $table->boolean('wizard');
            $table->string('ancestry')->nullable();
            $table->string('eyeColour')->nullable();
            $table->string('hairColour')->nullable();
            $table->json('wand');
            $table->string('patronus')->nullable();
            $table->boolean('hogwartsStudent');
            $table->boolean('hogwartsStaff');
            $table->string('actor')->nullable();
            $table->json('alternate_actors');
            $table->boolean('alive');
            $table->string('image')->nullable();
            $table->timestamps();
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
