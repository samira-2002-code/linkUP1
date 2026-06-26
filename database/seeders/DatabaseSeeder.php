<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users.
        User::factory(10)->create();

        // Create 30 posts (each is linked to a random user by the factory).
        Post::factory(30)->create();
    }
}
