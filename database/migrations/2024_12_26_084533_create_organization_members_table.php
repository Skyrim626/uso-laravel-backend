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
        // Organization Members table
        Schema::create('organization_members', function (Blueprint $table) {
            $table->uuid('member_id');
            $table->uuid('organization_id');
            $table->enum('status', ['pending', 'approved', 'kicked'])->default('pending');  // Pending by default

            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_members');
    }
};
