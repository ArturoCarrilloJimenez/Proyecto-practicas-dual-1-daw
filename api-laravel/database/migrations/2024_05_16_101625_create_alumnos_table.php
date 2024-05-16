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
        Schema::create('Students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('alternate_names');
            $table->string('species');
            $table->string('gender');
            $table->string('house');
            $table->string('date_of_birth');
            $table->integer('year_of_birth');
            $table->boolean('wizard');
            $table->string('ancestry');
            $table->string('eye_colour');
            $table->string('hair_colour');
            $table->json('wand');
            $table->string('patronus');
            $table->boolean('hogwarts_student');
            $table->boolean('hogwarts_staff');
            $table->string('actor');
            $table->json('alternate_actors');
            $table->boolean('alive');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
