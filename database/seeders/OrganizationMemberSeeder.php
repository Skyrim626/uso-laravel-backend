<?php

namespace Database\Seeders;

use App\Models\OrganizationMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationMemberSeeder extends OrganizationSeeder
{
    private $ULTRAMARINE_IDS = [
        "9c77f2b7-68b4-4f2f-a1b5-c1e7a7b8a13d",
        "47a1c326-3f6a-4f88-87b5-d72c9c8e10fc",
        "5b27e123-bc4f-4857-a027-1b6587cde045",
        "8e1f90cb-cb45-4a9a-b2e2-f0a6a734d914",
        "da53c724-4a9d-402f-8493-f8c6bd041ab7",
        "b872f408-b87d-4c33-b7f9-9286ecdb8d12",
        "6a82f316-2d6a-4534-a4c9-e6fa4c5f8e32",
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'first_name' => 'Ultramarine',
                'middle_name' => 'Bravo',
                'last_name' => 'Member',
                'username' => 'ultramarine.bravo',
                'email' => 'ultramarine.bravo@example.com',
                'password' => bcrypt('password123'),
                'course_id' => 1,
            ],
            [
                'first_name' => 'Ultramarine',
                'middle_name' => 'Charlie',
                'last_name' => 'Member',
                'username' => 'ultramarine.charlie',
                'email' => 'ultramarine.charlie@example.com',
                'password' => bcrypt('password123'),
                'course_id' => 1,
            ],
            [
                'first_name' => 'Ultramarine',
                'middle_name' => 'Delta',
                'last_name' => 'Member',
                'username' => 'ultramarine.delta',
                'email' => 'ultramarine.delta@example.com',
                'password' => bcrypt('password123'),
                'course_id' => 1,
            ],
            [
                'first_name' => 'Ultramarine',
                'middle_name' => 'Echo',
                'last_name' => 'Member',
                'username' => 'ultramarine.echo',
                'email' => 'ultramarine.echo@example.com',
                'password' => bcrypt('password123'),
                'course_id' => 1,
            ],
            [
                'first_name' => 'Ultramarine',
                'middle_name' => 'Foxtrot',
                'last_name' => 'Member',
                'username' => 'ultramarine.foxtrot',
                'email' => 'ultramarine.foxtrot@example.com',
                'password' => bcrypt('password123'),
                'course_id' => 1,
            ],
            [
                'first_name' => 'Ultramarine',
                'middle_name' => 'Golf',
                'last_name' => 'Member',
                'username' => 'ultramarine.golf',
                'email' => 'ultramarine.golf@example.com',
                'password' => bcrypt('password123'),
                'course_id' => 1,
            ],
            [
                'first_name' => 'Ultramarine',
                'middle_name' => 'Hotel',
                'last_name' => 'Member',
                'username' => 'ultramarine.hotel',
                'email' => 'ultramarine.hotel@example.com',
                'password' => bcrypt('password123'),
                'course_id' => 1,
            ],
        ];

        foreach ($members as $key => $member) {
            $member['id'] = $this->ULTRAMARINE_IDS[$key];
            $user = User::create($member);

            // Assign organization membership with different statuses
            $status = match ($key) {
                0, 1, 2 => 'pending',  // First 3 members
                3, 4 => 'approved',    // Next 2 members
                5, 6 => 'kicked',      // Last 2 members
            };

            OrganizationMember::create([
                'organization_id' => $this->ULTRAMARINES_ORGANIZATION_ID,
                'member_id' => $user->id,
                'status' => $status,
            ]);
        }
    }
}
