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
        Schema::create('positions', function (Blueprint $table) {
       
            $table->uuid('id')->primary();
            $table->uuid('election_id');
            $table->string('name'); // e.g., "President", "Vice President"
            
            $table->integer('max_candidates')->default(1); // Max candidates for the position
            $table->timestamps();

            $table->foreign('election_id')->references('id')->on('elections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
