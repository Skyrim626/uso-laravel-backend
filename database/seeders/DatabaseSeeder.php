<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Initialize Defined Seeders
        $this->call([
            CourseSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
            PredefinedSeeder::class,
            CurricularSeeder::class,
            OrganizationSeeder::class,
            OrganizationMemberSeeder::class,
            ElectionSeeder::class,
            MerchandiseSeeder::class, 
        ]);
    }
}
