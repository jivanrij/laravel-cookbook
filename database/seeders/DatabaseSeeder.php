<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\PersonalInfo;
use App\Models\Post;
use App\Models\User;
use Faker\Provider\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jonathan van Rij',
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
                    ->count(3)
            )
            ->has(PersonalInfo::factory())
            ->create();

    }
}
