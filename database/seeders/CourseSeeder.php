<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          /**
         * College: College of Information Technology and Computing
         */
        Course::insert([
            [
                "id" => 1,
                "name" => "Bachelor of Science in Information Technology",
            ],
            [
                "id" => 2,
                "name" => "Bachelor of Science in Technology Communication Management",
            ],
            [
                "id" => 3,
                "name" => "Bachelor of Science in Data Science",
            ],
            [
                "id" => 4,
                "name" => "Bachelor of Science in Computer Science",

            ],
        ]);

        /**
         * College: College of Engineering and Architecture
         */
        Course::insert([
            [

                "name" => "Bachelor of Science in Architecture",

            ],
            [

                "name" => "Bachelor of Science in Civil Engineering",

            ],
            [

                "name" => "Bachelor of Science in Mechanical Engineering",

            ],
            [

                "name" => "Bachelor of Science in Computer Engineering",

            ],
            [

                "name" => "Bachelor of Science in Geodetic Engineering",

            ],
            [

                "name" => "Bachelor of Science in Electrical Engineering",

            ],
            [

                "name" => "Bachelor of Science in Electronics Engineering",

            ],
        ]);

      

        /**
         * College: College of Science and Mathematics
         */
        Course::insert([
            [
                "name" => "Bachelor of Science in Applied Mathemathics",
            ],

            [


                "name" => "Bachelor of Science in Applied Physics"
            ],
            [


                "name" => "Bachelor of Science in Chemistry"
            ],
            [


                "name" => "Bachelor of Science in Environmental Science"
            ],
            [


                "name" => "Bachelor of Science in Food Technology"
            ],
        ]);

        /**
         * College: College of Science and Technology Education
         */
        Course::insert([
            [


                "name" => "Bachelor in Secondary Education Major in Science"
            ],
            [


                "name" => "Bachelor in Secondary Education Major in Mathematics"
            ],
            [


                "name" => "Bachelor in Technology and Livelihood Education"
            ],
            [


                "name" => "Bachelor in Technical Vocational Teacher Education"
            ],
        ]);

        /**
         * College: College of Technology
         */
        Course::insert([
            [
                "name" => "Bachelor of Science in Electronics Technology"
            ],
            [
                "name" => "Bachelor of Science in Autotronics"
            ],
            [
                "name" => "Bachelor of Science in Energy Systems and Management"
            ],
            [
                "name" => "Bachelor of Science in Electro-Mechanical Technology"
            ],
            [
                "name" => "Bachelor of Science in Manufacturing Engineering Technology"
            ],
        ]);
    }
}
