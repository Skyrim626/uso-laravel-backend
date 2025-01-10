<?php

namespace Database\Seeders;

use App\Models\Curricular;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurricularSeeder extends PredefinedSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Curriculars
        Curricular::insert([
            [
                'id' => $this->CURRICULAR_ID,
                'name' => 'Curricular'
            ],
            [
                'id' => $this->NON_CURRICULAR_ID,
                'name' => 'Non-curricular'
            ],
        ]);
    }
}
