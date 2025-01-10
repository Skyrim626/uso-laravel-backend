<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrganizationSeeder extends PredefinedSeeder
{

    protected $GOOGLE_ORGANIZATION_ID = "1476dc58-2d15-44ef-a8ef-34854e40e0ae";
    protected $ULTRAMARINES_ORGANIZATION_ID = "00707269-9aff-4593-a888-cc0239b9402f";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        // Intialize $curricularOrganizations variable
        $curricularOrganizations = $this->generateUUIDsForArray($this->getAllCurricularOrganizations());

        // Initialize $nonCurricularOrganizations
        $nonCurricularOrganizations = $this->generateUUIDsForArray($this->getAllNonCurricularOrganizations());

        /**
         * - Merged array
         * - Create a organization model in each array
         */
        $mergedOrganizations = array_merge($curricularOrganizations, $nonCurricularOrganizations);

        foreach($mergedOrganizations as $organization) {

            // print_r($organization); // Shows full associative array for debuggingGoverning Council - USTP CDO" not a associative array
            $organization = Organization::create($organization);

        }

   
    }
    

    /**
     * Summary of getAllNonCurricularOrganizations: A private function that gets all non-curricular organizations
     * @return array
     */
    private function getAllNonCurricularOrganizations() {
        $nonCurricularOrganizations = [
            [
                "name" => "Federation of Accredited Extra-curricular Student Organizations",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Al-Raid Muslim Student Organization",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Leadership Empowerment and Development Society",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Red Cross Youth - USTP Council",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Peer Group Society",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "USTP-Chess Enthusiasts",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "USTP Balangaw (USBAW)",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "id" => $this->GOOGLE_ORGANIZATION_ID,
                "name" => "Google Developer Student Clubs USTP",
                "curricular_id" => $this->NON_CURRICULAR_ID,
                "officer_id" => $this->OFFICER_ID,
            ],
            [
                "name" => "USTP Spiritual Ministry",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "USTP Scholars' Society",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "University City Scholars - USTP",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "USTP DOST-SEI Scholars Guild",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Association of CHED-TES Scholars",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "DBP RISE for Excellent Academe Maneuvers",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "External Grantees Association",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Tulong Dunong Program - Association of Student Learning Companion",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Tugon - RBR SM Foundation Scholars' Circle",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Arts and Culture Division",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Sanghimig Chorale",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Playmakers",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Gintong Amihan Dance Troupe",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Clique Point",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "Circulo de Entablado",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "USTP ELITE Models",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "USTP University Digital Arts",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "The Host - USTP",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "name" => "The Trailblazer Publication",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
            [
                "id" => $this->ULTRAMARINES_ORGANIZATION_ID,
                "name" => "Ultramarines Chapter",
                "curricular_id" => $this->NON_CURRICULAR_ID,
            ],
        ];

        // Return list of non curricular organizations
        return $nonCurricularOrganizations;
    }

    /**
     * Summary of getAllCurricularOrganizations: A private function that gets all curricular organizations
     * @return array
     */
    private function getAllCurricularOrganizations() {
        // Curricular Organizations
        $curricularOrganizations = [
            [
                "name" => "Student Council of Engineering and Architecture",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "United Architects of the Philippines Student Auxiliary",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Institute of Computer Engineers of the Philippines",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Junior Philippine Society Of Mechanical Engineers-USTP Chapter",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Junior Philippine Institute of Civil Engineers",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Junior Institute of Electronics Engineers of the Philippines",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Institute of Integrated Electrical Engineers CSC USTP",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Association of Geodetic Engineering Students",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Student Council of Information Technology and Computing",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "State University Technology Communication Management Society",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Society of Information Technology Enthusiasts",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Guild of Junior Data Scientists",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Student Council of Science and Mathematics",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "State University Mathematics Society",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Philippine Association of Food Technologists",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Environmental Science Society",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Chemistry Society",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Applied Physical Sciences Society",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Student Council of Science and Technology Education",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Association of Research Innovation and Extension Services",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Mathematics and Physical Sciences Educators' Society",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Student Council of Technology",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Society of Manufacturing Engineering Technology",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Society of Electronics and Communications Technology",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "State of University Electro-Mechanical Technology Society",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "State University of Electrical Technology Society",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            [
                "name" => "Senior High School Governing Council - USTP CDO",
                "curricular_id" => $this->CURRICULAR_ID,
            ],
            
        ];

        // Return list of curricular organizations
        return $curricularOrganizations;
    }
}
