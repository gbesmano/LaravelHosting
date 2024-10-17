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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->enum('rating', ['1', '2', '3', '4', '5']);
            $table->string('review_title');
            $table->longText('comment');
            $table->date('date');
            $table->string('proof');
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('destinations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
