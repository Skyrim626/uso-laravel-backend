<?php

namespace Database\Seeders;

use App\Models\Election;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectionSeeder extends OrganizationSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Create Election Seeder
        $election = Election::create([
            'organization_id' => $this->GOOGLE_ORGANIZATION_ID,
            'title' => 'Gogole Student Council Election 2025',
            'description' => 'Election for the student council representatives for the year 2025.',
            'start_date' => now(),
            'end_date' => now()->addDays(3),
        ]);

    }
}
