<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Categories
        Category::insert([
           [
            'name' => 'T-Shirts & Polos',
            'description' => 'Custom T-Shirts, Custom Polos',
           ],
           [
            'name' => 'Button-Down Shirts',
            'description' => 'Casual Button-Down Shirts, Event-specific Shirts',
           ],
           [
            'name' => 'Sports Team Merchandise',
            'description' => 'Team Jerseys, Sports Uniforms, Warm-Up Jackets',
           ],
           [
            'name' => 'Club/Organization Merchandise',
            'description' => 'Club T-Shirts, Club Polos, Club Jackets',
           ],
           [
            'name' => 'Event-specific Merchandise',
            'description' => 'Event T-Shirts (e.g., for festivals, charity events), Event Polos',
           ],
           [
            'name' => 'Outerwear',
            'description' => 'Hoodies & Sweatshirts, Jackets & Windbreakers',
           ],
           [
            'name' => 'Accessories',
            'description' => 'Caps & Hats, Bags & Backpacks, Scarves & Bandanas, Keychains & Lanyards',
           ],
           [
            'name' => 'Graduation Merchandise',
            'description' => 'Graduation T-Shirts, Graduation Hoodies, Graduation Caps & Gowns',
           ],
           [
            'name' => 'Footwear',
            'description' => 'Custom Sneakers or Slippers, Team-specific Footwear',
           ],
           [
            'name' => 'Miscellaneous Merchandise',
            'description' => 'Mugs & Water Bottles, Stationery (Pens, Notebooks), Stickers & Patches',
           ],
        ]);
    }
}
