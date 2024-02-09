<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Siroko\Domain\User\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create(); // Create 10 users

        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@siroko.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
