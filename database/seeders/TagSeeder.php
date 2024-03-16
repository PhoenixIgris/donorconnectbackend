<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Clothing & Accessories', 'slug' => 'clothing-accessories', 'description' => 'Includes clothing items such as shirts, pants, dresses, jackets, shoes, hats, scarves, gloves, and accessories like belts, purses, and jewelry.'],
            ['name' => 'Household Items', 'slug' => 'household-items', 'description' => 'Covers various household items such as kitchenware, appliances, furniture, home decor, bedding, curtains, rugs, and other essentials for home living.'],
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Encompasses electronic devices such as smartphones, laptops, tablets, desktop computers, TVs, cameras, gaming consoles, headphones, and other gadgets.'],
            ['name' => 'Books & Media', 'slug' => 'books-media', 'description' => 'Involves books of different genres, magazines, DVDs, CDs, vinyl records, audiobooks, and other forms of media including educational materials.'],
            ['name' => 'Toys & Games', 'slug' => 'toys-games', 'description' => 'Includes toys for children of all ages, board games, puzzles, outdoor play equipment, video games, action figures, dolls, and other recreational items.'],
            ['name' => 'Sports & Fitness', 'slug' => 'sports-fitness', 'description' => 'Covers sports equipment like balls, bats, rackets, helmets, gym gear, exercise machines, yoga mats, weights, and accessories for various physical activities.'],
            ['name' => 'Baby & Kids', 'slug' => 'baby-kids', 'description' => 'Comprises items specifically for infants and children such as clothing, toys, cribs, strollers, car seats, diapers, feeding supplies, and nursery essentials.'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty', 'description' => 'Involves personal care products including skincare items, cosmetics, hair care products, toiletries, vitamins, supplements, and other health-related items.'],
            ['name' => 'Food & Beverages', 'slug' => 'food-beverages', 'description' => 'Encompasses non-perishable food items, canned goods, packaged snacks, beverages, cooking ingredients, spices, and other food-related donations.'],
            ['name' => 'Pet Supplies', 'slug' => 'pet-supplies', 'description' => 'Includes pet food, toys, bedding, grooming tools, leashes, collars, litter boxes, and other supplies for cats, dogs, and other companion animals.'],
            ['name' => 'School & Office Supplies', 'slug' => 'school-office-supplies', 'description' => 'Covers school supplies such as notebooks, pens, pencils, backpacks, calculators, as well as office supplies like paper, folders, staplers, and desk organizers.'],
            ['name' => 'Outdoor & Gardening', 'slug' => 'outdoor-gardening', 'description' => 'Involves outdoor equipment, gardening tools, plant pots, seeds, watering cans, lawn care items, patio furniture, and accessories for outdoor activities.'],
            ['name' => 'Art & Crafts', 'slug' => 'art-crafts', 'description' => 'Includes art supplies such as paints, brushes, canvases, sketchbooks, crafting materials like beads, yarn, fabric, and DIY project kits for various creative activities.'],
            ['name' => 'Travel & Luggage', 'slug' => 'travel-luggage', 'description' => 'Encompasses travel essentials like luggage, backpacks, travel-sized toiletries, passport holders, travel pillows, and accessories for travelers.'],
            ['name' => 'Music Instruments', 'slug' => 'music-instruments', 'description' => 'Covers musical instruments such as guitars, pianos, drums, violins, saxophones, flutes, keyboards, and accessories like instrument cases, stands, and sheet music.'],
            ['name' => 'Home Improvement', 'slug' => 'home-improvement', 'description' => 'Involves tools and materials for home renovation and repair, including power tools, hand tools, paint, hardware, plumbing fixtures, electrical supplies, and DIY guides.'],
            ['name' => 'Tech Accessories', 'slug' => 'tech-accessories', 'description' => 'Includes accessories for electronic devices such as phone cases, laptop sleeves, chargers, cables, screen protectors, keyboard covers, and styluses.'],
            ['name' => 'Party Supplies', 'slug' => 'party-supplies', 'description' => 'Comprises decorations, tableware, balloons, party favors, costumes, and other supplies for celebrations such as birthdays, weddings, graduations, and holidays.'],
            ['name' => 'Fashion Jewelry', 'slug' => 'fashion-jewelry', 'description' => 'Involves trendy and costume jewelry pieces such as necklaces, bracelets, earrings, rings, anklets, and body chains, made from various materials like metals, beads, and crystals.'],
            ['name' => 'Automotive Accessories', 'slug' => 'automotive-accessories', 'description' => 'Covers accessories for vehicles such as car seat covers, floor mats, steering wheel covers, car organizers, air fresheners, and maintenance tools like tire inflators and car care kits.'],
            ['name' => 'DIY & Craft Supplies', 'slug' => 'diy-craft-supplies', 'description' => 'Includes materials for do-it-yourself projects and crafts such as fabric, paper, wood, beads, paint, glue, sewing notions, and crafting tools like scissors, rulers, and cutting mats.'],
            ['name' => 'Fitness Accessories', 'slug' => 'fitness-accessories', 'description' => 'Encompasses accessories for fitness and exercise routines such as resistance bands, exercise balls, workout gloves, fitness trackers, water bottles, and recovery tools like foam rollers and massage balls.'],        
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag['name'],
                'slug' => $tag['slug'],
                'description' => $tag['description'],
            ]);
        }
    }
}
