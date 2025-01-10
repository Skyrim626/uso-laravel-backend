<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PredefinedSeeder extends BaseSeeder
{

    protected $CURRICULAR_ID = "19eb8184-ebed-42c8-90c9-016ac27e8aca";
    protected $NON_CURRICULAR_ID = "899c1205-6ae7-4096-bd01-273059e91ed4";
    protected $OFFICER_ID = "6985a1f9-7804-4de5-87db-71ae63332b8a";
    protected $STUDENT_ID = "d2830790-4a30-4f29-9f38-e1b778c9cd4f";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $ADMIN_ID = Str::uuid()->toString();

        // Insert Users
        $users = User::insert([
            [
                'id' => $ADMIN_ID, // Generate and assign UUID
                'first_name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin'),
            ],
            [
                'id' => $this->OFFICER_ID, // Generate and assign UUID
                'first_name' => 'SCEA Officer',
                'username' => 'org.officer',
                'email' => 'sceaOrgOfficer@example.com',
                'password' => bcrypt('orgofficer'),
            ],
         
         
        ]);

        // Create Student
        $student = User::create([
            'id' => $this->STUDENT_ID, // Generate and assign UUID
            'first_name' => 'John Doe',
            'username' => 'john.username',
            'email' => 'johnDoe@example.com',
            'password' => bcrypt('student123'),
            'course_id' => 1,
        ],);


        // Create User Roles
        UserRole::insert([
            [
                'user_id' => $ADMIN_ID, // ID
                'role_id' => 1, // Role (Admin)
            ],
            [
                'user_id' => $this->OFFICER_ID, // ID
                'role_id' => 2, // Role (Officer)
            ],
            [
                'user_id' => $this->STUDENT_ID, // ID
                'role_id' => 3, // Role (Student)
            ]
        ]);

        // Create 10 student users with role_id 3
        User::factory(10)->create()->each(function ($user) {
          
            // Assign student role to each created user
            UserRole::factory()->create([
                'user_id' => $user->id,
                'role_id' => 3, // Assign student role
            ]);
        });
    }
}
