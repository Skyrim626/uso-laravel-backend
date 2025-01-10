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
        // Curriculars Table
        Schema::create('curriculars', function (Blueprint $table) {
            // Replaced 'curricularID to id'
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            /**
             * December 26, 2024: Replaced 'c_logo to logo_url'
             */
            $table->string('logo_url')->nullable();
            // December 26, 2024: Replaced 'noncurricular to isNoncurricular'
            $table->boolean('is_noncurricular')->default(false);

            // * Removed the OrgID

            // December 26, 2024: Added created_at and updated_at
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculars');
    }
};
