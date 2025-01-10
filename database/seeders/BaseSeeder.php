<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    
    /**
     * Summary of generateUUIDsForArray: A protected function that generates UUIDs for elements in an array.
     * @param array $lists
     * @return array
     */
    protected function generateUUIDsForArray(array $lists) {

        foreach($lists as &$list) {
            if (is_array($list) && !isset($list['id'])) {
                $list['id'] = Str::uuid()->toString();
            }
        }

        // Return lists 
        return $lists;

    }

    /**
     * Summary of generateUUID: A protected function that generates and return the UUID.
     * @return string
     */
    protected function generateUUID() {
      

        return  Str::uuid()->toString();
    }
}
