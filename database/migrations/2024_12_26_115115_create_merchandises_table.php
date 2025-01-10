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

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->unique();
            $table->timestamps();
        });

        Schema::create('merchandises', function (Blueprint $table) {
          
            $table->uuid('id')->primary();
            $table->uuid('organization_id');

            $table->foreignId('category_id')->nullable()->constrained('categories');
         
            $table->string('name');
            $table->string('description');
            // $table->string('size');
            $table->enum('size', ['XS', 'S', 'M', 'L', 'XL', 'XXL'])->nullable();  // Define size as an enum
            $table->string('color', 7)->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Add foreign key constraints
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });

        Schema::create('merchandise_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('merchandise_id');

            /**
             * Required: As each merchandises has images it must have a main image for specific purposes (table, view merchandise)
             */
            $table->boolean('isMain');
            $table->string('image_url');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('merchandise_id')->references('id')->on('merchandises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandise_images');
        Schema::dropIfExists('merchandises');
        Schema::dropIfExists('categories');
    }
};
