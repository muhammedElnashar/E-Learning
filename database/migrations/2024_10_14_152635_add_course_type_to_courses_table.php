<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->enum('course_type', ['video', 'live'])->default('video');
            $table->string('live_platform')->nullable(); 
            $table->string('live_link')->nullable();
            $table->dateTime('live_schedule')->nullable();
            $table->string('live_details')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['course_type', 'live_platform', 'live_link', 'live_schedule', 'live_details']);
        });
    }
};
