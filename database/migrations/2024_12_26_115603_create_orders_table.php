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
        Schema::create('orders', function (Blueprint $table) {
           
            $table->uuid('id')->primary();
            $table->uuid('user_id');

            $table->float('total')->default(0); // Total is calculated
            $table->enum('status', ['pending', 'shipped', 'completed', 'canceled'])->default('pending');
            $table->timestamps();

             // Add foreign key constraints
             $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
