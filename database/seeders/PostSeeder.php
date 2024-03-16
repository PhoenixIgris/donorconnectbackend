<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            ['name' => 'Kathmandu', 'latitude' => 27.7172, 'longitude' => 85.3240],
            ['name' => 'Pokhara', 'latitude' => 28.2639, 'longitude' => 83.9724],
            ['name' => 'Biratnagar', 'latitude' => 26.4561, 'longitude' => 87.2700],
            ['name' => 'Lalitpur', 'latitude' => 27.6742, 'longitude' => 85.3240],
            ['name' => 'Bharatpur', 'latitude' => 27.6789, 'longitude' => 84.4349],
            ['name' => 'Birgunj', 'latitude' => 27.0104, 'longitude' => 84.8770],
            ['name' => 'Dharan', 'latitude' => 26.8149, 'longitude' => 87.2849],
            ['name' => 'Janakpur', 'latitude' => 26.7100, 'longitude' => 85.9249],
            ['name' => 'Hetauda', 'latitude' => 27.4306, 'longitude' => 85.0299],
            ['name' => 'Butwal', 'latitude' => 27.7008, 'longitude' => 83.4484],
        ];
        $posts = [
            [
                'title' => 'Stylish Winter Coat',
                'category_id' => 1, // New
                'desc' => 'Stay warm and fashionable this winter with our stylish coat. Made from high-quality materials, this coat will keep you cozy in chilly weather. Don\'t sacrifice style for warmth - get yours now!',
                'image' => $this->searchCommons('coat'), // Use the $this->$this->searchCommons function to get the image URL
                'tag_ids' => [1, 7] // Clothing & Accessories, Open Box
            ],
            [
                'title' => 'Smart LED TV',
                'category_id' => 3, // Like New
                'desc' => 'Upgrade your home entertainment with our smart LED TV. With stunning picture quality and smart features, you can enjoy your favorite shows and movies like never before. Don\'t miss out on this deal!',
                'image' => $this->searchCommons('smartTV'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [3, 6] // Electronics, Sports & Fitness
            ],
            [
                'title' => 'Vintage Vinyl Records Collection',
                'category_id' => 6, // Vintage
                'desc' => 'Calling all music enthusiasts! Explore our collection of vintage vinyl records and discover classic tunes from decades past. Add some nostalgia to your music collection today.',
                'image' => $this->searchCommons('records'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [4, 11] // Books & Media, Outdoor & Gardening
            ],
            [
                'title' => 'Cozy Knit Sweater',
                'category_id' => 1, // New
                'desc' => 'Get ready for sweater weather with our cozy knit sweater. Made from soft, breathable fabric, it\'s perfect for staying warm and stylish all season long.',
                'image' => $this->searchCommons('sweater'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [1, 11] // Clothing & Accessories, Outdoor & Gardening
            ],
            [
                'title' => 'Kitchen Essentials Bundle',
                'category_id' => 2, // Used
                'desc' => 'Upgrade your kitchen with our essentials bundle. Includes pots, pans, utensils, and more. Everything you need to cook up delicious meals!',
                'image' => $this->searchCommons('kitchenware'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [2, 12] // Household Items, School & Office Supplies
            ],
            [
                'title' => 'Smartphone - Like New',
                'category_id' => 3, // Like New
                'desc' => 'Looking for a new smartphone? Look no further! Our like-new smartphone is in excellent condition and comes with all the latest features.',
                'image' => $this->searchCommons('smartphone'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [3, 8] // Electronics, Health & Beauty
            ],
            [
                'title' => 'Children\'s Educational Toys',
                'category_id' => 7, // Baby & Kids
                'desc' => 'Spark your child\'s imagination with our collection of educational toys. From puzzles to building blocks, these toys are designed to promote learning and creativity.',
                'image' => $this->searchCommons('educational'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [5, 10] // Toys & Games, Pet Supplies
            ],
            [
                'title' => 'Fitness Equipment Set',
                'category_id' => 5, // Sports & Fitness
                'desc' => 'Get in shape with our fitness equipment set. Includes dumbbells, resistance bands, and exercise mat. Start your fitness journey today!',
                'image' => $this->searchCommons('fitness'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [6, 9] // Sports & Fitness, Food & Beverages
            ],
            [
                'title' => 'Vintage Record Player',
                'category_id' => 6, // Vintage
                'desc' => 'Experience the nostalgia of vinyl with our vintage record player. Fully restored and ready to play your favorite records, it\'s the perfect addition to any music lover\'s collection.',
                'image' => $this->searchCommons('player'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [4, 3] // Books & Media, Electronics
            ],
            [
                'title' => 'Handcrafted Wooden Desk',
                'category_id' => 8, // Custom
                'desc' => 'Add a touch of elegance to your workspace with our handcrafted wooden desk. Made from high-quality hardwood, it\'s both stylish and functional. Elevate your office today!',
                'image' => $this->searchCommons('desk'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [2, 12] // Household Items, School & Office Supplies
            ],
            [
                'title' => 'Organic Baby Clothing Set',
                'category_id' => 7, // Baby & Kids
                'desc' => 'Keep your little one cozy and comfortable with our organic baby clothing set. Made from soft, breathable cotton, it\'s gentle on delicate skin. Perfect for your precious bundle of joy!',
                'image' => $this->searchCommons('baby'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [1, 10] // Clothing & Accessories, Pet Supplies
            ],
            [
                'title' => 'Gourmet Tea Sampler',
                'category_id' => 9, // Food & Beverages
                'desc' => 'Indulge in the exquisite flavors of our gourmet tea sampler. Featuring a variety of premium teas from around the world, it\'s a treat for the senses. Sip, relax, and enjoy!',
                'image' => $this->searchCommons('tea'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [9, 11] // Food & Beverages, Outdoor & Gardening
            ],
            [
                'title' => 'DIY Garden Kit',
                'category_id' => 12, // Outdoor & Gardening
                'desc' => 'Get your hands dirty and unleash your inner gardener with our DIY garden kit. Includes everything you need to start your own garden - seeds, soil, pots, and more. Let your garden flourish!',
                'image' => $this->searchCommons('kit'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [10, 11] // Pet Supplies, Outdoor & Gardening
            ],
           
            
            [
                'title' => 'Designer Leather Handbag',
                'category_id' => 1, // New
                'desc' => 'Elevate your style with our designer leather handbag. Crafted from luxurious leather, its the perfect accessory to complement any outfit. Make a statement wherever you go!',
                'image' => $this->searchCommons('handbag'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [1, 7] // Clothing & Accessories, Open Box
            ],
            [
                'title' => 'Smart Home Security Camera',
                'category_id' => 3, // Like New
                'desc' => 'Keep your home safe and secure with our smart home security camera. With HD video quality and motion detection, you can monitor your home from anywhere. Peace of mind is just a click away!',
                'image' => $this->searchCommons('security-camera'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [3, 6] // Electronics, Sports & Fitness
            ],
            [
                'title' => 'Classic Literature Collection',
                'category_id' => 6, // Vintage
                'desc' => 'Immerse yourself in the world of classic literature with our collection of timeless novels and poetry. From Shakespeare to Austen, rediscover the literary classics that have stood the test of time.',
                'image' => $this->searchCommons('books'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [4, 11] // Books & Media, Outdoor & Gardening
            ],
            [
                'title' => 'Outdoor Camping Gear Set',
                'category_id' => 1, // New
                'desc' => 'Embark on your next outdoor adventure with our camping gear set. Includes tents, sleeping bags, cooking equipment, and more. Explore the great outdoors in comfort and style!',
                'image' => $this->searchCommons('camping-gear'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [10, 11] // Pet Supplies, Outdoor & Gardening
            ],
            [
                'title' => 'Professional Espresso Machine',
                'category_id' => 2, // Used
                'desc' => 'Indulge in cafe-quality espresso at home with our professional espresso machine. With advanced features and sleek design, its perfect for coffee enthusiasts and baristas alike. Start brewing your favorite espresso drinks today!',
                'image' => $this->searchCommons('espresso-machine'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [2, 12] // Household Items, School & Office Supplies
            ],
            [
                'title' => 'Luxury Skincare Gift Set',
                'category_id' => 3, // Like New
                'desc' => 'Treat yourself or someone special to our luxury skincare gift set. Featuring premium skincare products from top brands, its the ultimate pampering experience. Radiant skin awaits!',
                'image' => $this->searchCommons('skincare'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [3, 8] // Electronics, Health & Beauty
            ],
            [
                'title' => 'Interactive STEM Toys for Kids',
                'category_id' => 7, // Baby & Kids
                'desc' => 'Inspire young minds with our collection of interactive STEM toys for kids. From robotics to coding kits, these toys make learning fun and engaging. Spark curiosity and creativity in your child!',
                'image' => $this->searchCommons('stem-toys'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [5, 10] // Toys & Games, Pet Supplies
            ],
            [
                'title' => 'Premium Protein Powder',
                'category_id' => 5, // Sports & Fitness
                'desc' => 'Fuel your workouts and support muscle growth with our premium protein powder. Made from high-quality ingredients, its the perfect post-workout recovery fuel. Achieve your fitness goals faster!',
                'image' => $this->searchCommons('protein-powder'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [6, 9] // Sports & Fitness, Food & Beverages
            ],
            [
                'title' => 'Vintage Film Camera',
                'category_id' => 6, // Vintage
                'desc' => 'Capture timeless moments with our vintage film camera. Fully functional and beautifully crafted, its perfect for photography enthusiasts and collectors alike. Rediscover the art of film photography!',
                'image' => $this->searchCommons('film-camera'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [4, 3] // Books & Media, Electronics
            ],
            [
                'title' => 'Handmade Artisanal Jewelry',
                'category_id' => 8, // Custom
                'desc' => 'Adorn yourself with our handmade artisanal jewelry. Each piece is meticulously crafted by skilled artisans, making it a unique and special addition to your jewelry collection. Make a statement with our one-of-a-kind jewelry!',
                'image' => $this->searchCommons('jewelry'), // Use the $this->searchCommons function to get the image URL
                'tag_ids' => [1, 10] // Clothing & Accessories, Pet Supplies
            ],
        ];
        foreach ($posts as $index => $post) {
            $newPost = new Post();
            $address = Address::create($addresses[rand(0,9)]);
            $newPost->title = $post['title'];
            $newPost->category_id = $post['category_id'];
            $newPost->desc = $post['desc'];
            $newPost->image = $post['image'];
            $newPost->user_id = rand(1, 10);
            $newPost->address()->associate($address);
            
            $newPost->save();

            // Attach tags
            $newPost->tags()->attach($post['tag_ids']);
        }
    }


    public static function searchCommons($keyword)
    {
        $apiUrl = "https://api.bing.microsoft.com/v7.0/images/search?q=" . urlencode($keyword);

        // Make the API request
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false, // This line should be removed in production for security
            CURLOPT_HTTPHEADER => array(
                'Ocp-Apim-Subscription-Key: YOUR_SUBSCRIPTION_KEY' // Replace with your subscription key
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    
        // Process the API response
        $data = json_decode($response, true);
    
        // Check if there are any results
        if(isset($data['value'][0]['contentUrl'])) {
            // Return the URL of the first image
            return $data['value'][0]['contentUrl'];
        } else {
            // Provide a default image URL if no image is found
            return "https://cdn.aarp.net/content/dam/aarp/home-and-family/your-home/2022/01/1140-box-of-items-for-donations.jpg";
        }
    }
}
