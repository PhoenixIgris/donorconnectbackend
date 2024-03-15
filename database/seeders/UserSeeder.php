<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password123'),
                'phone_number' => '1234567890',
                'address' => '123 Main Street'
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'jane@example.com',
                'password' => bcrypt('password123'),
                'phone_number' => '9876543210',
                'address' => '456 Oak Avenue'
            ],
            [
                'first_name' => 'Alice',
                'last_name' => 'Smith',
                'email' => 'alice@example.com',
                'password' => bcrypt('password123'),
                'phone_number' => '5551234567',
                'address' => '789 Elm Street'
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Johnson',
                'email' => 'bob@example.com',
                'password' => bcrypt('password123'),
                'phone_number' => '5559876543',
                'address' => '321 Pine Avenue'
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Williams',
                'email' => 'emily@example.com',
                'password' => bcrypt('password123'),
                'phone_number' => '5557890123',
                'address' => '456 Maple Lane'
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael@example.com',
                'password' => bcrypt('password123'),
                'phone_number' => '5552345678',
                'address' => '987 Birch Street'
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Miller',
                'email' => 'sarah@example.com',
                'password' => bcrypt('password123'),
                'phone_number' => '5558765432',
                'address' => '654 Cedar Avenue'
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Martinez',
                'email' => 'david@example.com',
                'password' => bcrypt('password123'),
                'phone_number' => '5553456789',
                'address' => '321 Oak Lane'
            ],
        ];
            foreach ($users as $user) {
                $user['name']= $user['first_name'] . ' ' . $user['last_name'];

                $user = User::create($user);
                $success['token'] = $user->createToken('DonorConnect')->plainTextToken;
                    }
    
    }
}
