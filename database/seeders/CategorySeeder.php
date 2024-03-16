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
        $categories = [
            ['name' => 'New', 'slug' => 'new'],
            ['name' => 'Used', 'slug' => 'used'],
            ['name' => 'Like New', 'slug' => 'like-new'],
            ['name' => 'Damaged', 'slug' => 'damaged'],
            ['name' => 'Refurbished', 'slug' => 'refurbished'],
            ['name' => 'Vintage', 'slug' => 'vintage'],
            ['name' => 'Open Box', 'slug' => 'open-box'],
            ['name' => 'Custom', 'slug' => 'custom'],
            ['name' => 'Clearance', 'slug' => 'clearance'],
            ['name' => 'Limited Edition', 'slug' => 'limited-edition'],
            ['name' => 'Handmade', 'slug' => 'handmade'],
            ['name' => 'Antique', 'slug' => 'antique'],
            ['name' => 'Exclusive', 'slug' => 'exclusive'],
            ['name' => 'Premium', 'slug' => 'premium'],
            ['name' => 'High-End', 'slug' => 'high-end'],
            ['name' => 'Discounted', 'slug' => 'discounted'],
            ['name' => 'Luxury', 'slug' => 'luxury'],
            ['name' => 'Customized', 'slug' => 'customized'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
            ]);
        }
    }
}
