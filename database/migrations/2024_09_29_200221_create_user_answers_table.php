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
      
    Schema::create('user_answers', function (Blueprint $table) {
        $table->id(); // Primary key
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users
        $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); // Foreign key to questions
        $table->foreignId('answer_id')->constrained('answers')->onDelete('cascade'); // Foreign key to answers
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
