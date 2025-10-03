<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('runeterra_words', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('max_attempts')->default(6);
            $table->timestamps();
        });

        Schema::create('daily_words', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->foreignId('runeterra_word_id')->constrained('runeterra_words')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_words');
        Schema::dropIfExists('runeterra_words');
    }
};
