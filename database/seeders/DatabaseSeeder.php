<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\PersonalInfo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(
                Post::factory()
                    ->has(
                        Comment::factory()
                            ->count(4)
                    )
                    ->has(
                        Category::factory()
                            ->count(2)
                    )
                    ->count(10)
            )
            ->has(PersonalInfo::factory())
            ->create([
                'first_name' => 'Jonathan',
                'last_name' => 'van Rij',
                'email' => 'jonathan@blijnder.nl',
                'password' => Hash::make('secret'),
            ]);

        User::factory()
            ->count(10)
            ->has(
                Post::factory()
                    ->has(
                        Comment::factory()
                            ->count(4)
                    )
                    ->has(
                        Category::factory()
                            ->count(2)
                    )
                    ->count(10)
            )
            ->has(PersonalInfo::factory())
            ->create();


        // Create some more posts to be able to test the index properly
        Post::factory()->count(100);
    }
}
