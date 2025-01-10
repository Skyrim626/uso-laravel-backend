<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        Role::insert([
            [
                'id' => 1,
                'name' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'officer',
            ],
            [
                'id' => 3,
                'name' => 'student',
            ],
        ]);
    }
}
