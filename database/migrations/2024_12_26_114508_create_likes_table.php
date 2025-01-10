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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->uuid('announcement_id');

            $table->timestamps();

            // Ensure a user can like a post only once
            $table->unique(['user_id', 'announcement_id']);

             // Add foreign key constraints
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('announcement_id')->references('id')->on('announcements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
