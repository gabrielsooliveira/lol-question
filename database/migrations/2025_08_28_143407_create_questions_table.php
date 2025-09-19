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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->timestamps();
        });

        Schema::create('question_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->enum('locale', ['pt', 'en']);
            $table->text('text');
            $table->string('correct_answer');
            $table->json('options');
            $table->timestamps();

            $table->unique(['question_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('question_translations');
        Schema::dropIfExists('questions');
    }
};
