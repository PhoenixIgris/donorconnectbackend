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
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
            ]);
        }
    }
}
