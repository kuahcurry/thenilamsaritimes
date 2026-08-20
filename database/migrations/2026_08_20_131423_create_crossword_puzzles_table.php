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
        Schema::create('crossword_puzzles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('The Birthday Mini');
            $table->string('subtitle')->default("Test your insider knowledge of today's guest of honor");
            $table->integer('grid_rows')->default(5);
            $table->integer('grid_cols')->default(5);
            $table->json('grid_matrix'); // 2D array of { char: 'C', number: 1, isBlack: false }
            $table->json('clues_across'); // [{ number: 1, clue: '...', answer: '...' }]
            $table->json('clues_down'); // [{ number: 1, clue: '...', answer: '...' }]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crossword_puzzles');
    }
};
