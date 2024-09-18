<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "first_name"=>"sachita",
            "last_name"=>"shrestha",
            "name" => "sachita shrestha",
            "email"=>"sachitaadmin@gmail.com",
            'phone_number' => '1234567890',
             'address' => '456 Oak Avenue',
            "password"=>Hash::make('password')
        ]);

    }
}
