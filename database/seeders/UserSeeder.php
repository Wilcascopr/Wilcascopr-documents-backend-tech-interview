<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'testuser@email.com')->first();
        if (!$user)
            \App\Models\User::create([
                'name' => 'Test User',
                'email' => 'testuser@email.com',
                'password' => bcrypt('testpassword'),
            ]);
    }
}
