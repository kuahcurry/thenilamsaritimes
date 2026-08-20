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
        Schema::create('newspaper_settings', function (Blueprint $table) {
            $table->id();
            $table->string('newspaper_title')->default('THE CICI TIMES');
            $table->string('birthday_girl_name')->default('Cici');
            $table->string('age')->default('24');
            $table->string('edition_motto')->default("All The Joy That's Fit To Celebrate");
            $table->string('left_ear_text')->default("Special Commemorative Edition • Vol. XXIV No. 1 • Collector's Issue");
            $table->string('right_ear_text')->default('Forecast: 100% Sunshine, Laughter & Confetti');
            $table->text('breaking_ticker')->default("BREAKING: Global Celebrations Underway for Cici's 24th Birthday! • Historic Milestones Ahead • Outpouring of Love Reported Worldwide");
            $table->string('issue_date')->default('Thursday, August 20, 2026');
            $table->string('price')->default('$2.00 / PRICELESS');
            $table->string('volume_number')->default('VOL. CLXXV... No. 59,880');
            $table->string('audio_title')->default('Birthday Serenade & Loved Ones Toast');
            $table->string('audio_url')->nullable();
            $table->string('admin_pin')->default('1234');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newspaper_settings');
    }
};
