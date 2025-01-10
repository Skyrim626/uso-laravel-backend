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
        // Organizations Table
        Schema::create('organizations', function (Blueprint $table) {
             // Replaced 'OrgID to id'
             $table->uuid('id')->primary();
             $table->uuid('curricular_id');

            $table->uuid('officer_id')->nullable();

            $table->string('name');
            $table->string('address')->nullable();
            $table->string('logo_url')->nullable();
            /**
             * December 26, 2024: Replaced 'number to phone_number'
             * - Replaced data type integer to string.
             */
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable()->unique();

             // December 26, 2024: Added created_at and updated_at
            $table->timestamps();
            $table->softDeletes();

            // Add foreign key constraints
            $table->foreign('officer_id')->references('id')->on('users');
            // Add foreign key constraints
            $table->foreign('curricular_id')->references('id')->on('curriculars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
