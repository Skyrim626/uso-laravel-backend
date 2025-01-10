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

        /**
         * * December 24, Added Course Table
         * 
         * * - Courses Table
         */
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Roles Table
        Schema::create('roles', function (Blueprint $table) {

            // Replaced 'RoleID to id'
            $table->id();

            // Replaced 'RoleName to name'
            $table->string('name')->unique();

            // December 26, 2024: Added created_at and updated_at
            $table->timestamps();
        });

        // Users Table
        Schema::create('users', function (Blueprint $table) {
            // Replaced 'AccountID to id'
            $table->uuid('id')->primary();
            // * To be Analyzed
            // $table->string('course')->nullable();

            // * December 24, 2024 - Added Course Table
            $table->foreignId('course_id')->nullable()->constrained('courses');
            $table->string('year')->nullable();

            $table->string('first_name')->nullable();
            // December 26, 2024: Added middle_name
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('student_id')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('facebook_link_url')->nullable();

            // December 26, 2024: Added enum (male, female, others)
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            // Replaced 'birthday to date_of_birth'
            $table->date('date_of_birth')->nullable();
            /**
             * December 26, 2024: Replaced 'contact to phone_number'
             * - Replace data type from int to string
             */
            $table->string('phone_number')->nullable();
            $table->string('username')->unique();

            // December 26, 2024: Added email_verified_at
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // December 26, 2024: Added rememberToken function
            $table->rememberToken();
            // December 26, 2024: Added created_at and updated_at
            $table->timestamps();
        });

        // Users Role Table
        Schema::create('user_roles', function (Blueprint $table) {
            // * RoleName attribute is not included
            
            // December 24, 2024: Replaced 'AccountID to user_id'
            // Reference to the users table with a UUID
            $table->uuid('user_id');
            // December 24, 2024: Replaced 'roleID to role_id'
            $table->foreignId('role_id')->constrained('roles', 'id');

             // Add foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

             $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
