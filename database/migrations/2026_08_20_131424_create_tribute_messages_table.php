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
        Schema::create('tribute_messages', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('sender_relation')->nullable(); // e.g. "Best Friend", "Family", "Admirer"
            $table->text('message');
            $table->string('photo_url')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tribute_messages');
    }
};
