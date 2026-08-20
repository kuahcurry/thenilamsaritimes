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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('kicker')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('author')->default('Special to The Times');
            $table->string('dateline')->default('NEW YORK');
            $table->longText('content');
            $table->string('image_url')->nullable();
            $table->text('image_caption')->nullable();
            $table->string('image_credit')->nullable();
            $table->string('layout_zone')->default('lead_story'); // lead_story, hero_side, opinion, arts_leisure, briefs, classifieds
            $table->string('category')->default('CELEBRATION');
            $table->boolean('is_featured')->default(false);
            $table->integer('order_num')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
