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
        Schema::create('candidates', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('position_id');
            $table->uuid('user_id');

            $table->string('photo_url')->nullable();
            $table->string('cor_url')->nullable();
            $table->string('grades_url')->nullable();
            $table->string('moral_url')->nullable();
            $table->string('certificate_url')->nullable();
            $table->string('pds_url')->nullable();
            $table->string('facebook_link')->nullable();
            $table->timestamps();

              // Add foreign key constraints
              $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
              $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
