<?php

namespace Database\Seeders;

use App\Models\Merchandise;
use App\Models\MerchandiseImage;
use Illuminate\Database\Seeder;

class MerchandiseSeeder extends OrganizationSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined array of merchandise data with UUIDs
        $merchandises = [
            [
                'id' => '248a44d8-63aa-4c0a-a3cc-39b5af05e521',  // Predefined UUID for T-Shirt
                'organization_id' => $this->ULTRAMARINES_ORGANIZATION_ID,
                'category_id' => 1,
                'name' => 'T-Shirt',
                'description' => 'Comfortable cotton t-shirt for daily wear.',
                'size' => 'M',
                'color' => '#ff0000',  // CSS Hex color code for Red
                'price' => 19.99,
                'quantity' => 100,
            ],
            [
                'id' => '32f1bc8d-649a-47a9-bd19-6c7db6fe417a',  // Predefined UUID for Cap
                'organization_id' => $this->ULTRAMARINES_ORGANIZATION_ID,
                'category_id' => 2,
                'name' => 'Cap',
                'description' => 'Stylish cap for sunny days.',
                'size' => 'XL',
                'color' => '#000000',  // CSS Hex color code for Black
                'price' => 14.99,
                'quantity' => 50,
            ],
            [
                'id' => 'c0d6d217-5d42-4a73-8992-ea66e84de21f',  // Predefined UUID for Hoodie
                'organization_id' => $this->ULTRAMARINES_ORGANIZATION_ID,
                'category_id' => 1,
                'name' => 'Hoodie',
                'description' => 'Warm hoodie perfect for colder weather.',
                'size' => 'L',
                'color' => '#0000ff',  // CSS Hex color code for Blue
                'price' => 29.99,
                'quantity' => 75,
            ],
            [
                'id' => 'ae9d7e94-f2bb-4f8b-94d9-d27811a75a4a',  // Predefined UUID for Mug
                'organization_id' => $this->ULTRAMARINES_ORGANIZATION_ID,
                'category_id' => 3,
                'name' => 'Mug',
                'description' => 'Ceramic mug for your favorite beverage.',
                'size' => 'S',
                'color' => '#ffffff',  // CSS Hex color code for White
                'price' => 9.99,
                'quantity' => 150,
            ],
            [
                'id' => '7f9ba4a5-cb31-470b-bf64-1a88b9c0341f',  // Predefined UUID for Jacket
                'organization_id' => $this->ULTRAMARINES_ORGANIZATION_ID,
                'category_id' => 2,
                'name' => 'Jacket',
                'description' => 'Premium jacket for all seasons.',
                'size' => 'XL',
                'color' => '#808080',  // CSS Hex color code for Gray
                'price' => 49.99,
                'quantity' => 30,
            ],
        ];

        // Loop through the array and create merchandise items
        foreach ($merchandises as $merchandise) {
            Merchandise::create($merchandise);
            MerchandiseImage::create([
                "merchandise_id" => $merchandise['id'],
                "image_url" => "https://via.placeholder.com/150?text=Product",
                "isMain" => true,
            ]);
        }
    }
}
