<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    protected $model = Post::class;


    public function definition()
    {
        if (!User::all()->count()) {
            User::factory()->create();
        }

        return [
            'title' => ucfirst($this->faker->words(4, true)),
            'user_id' => User::all()->random()->id
        ];
    }
}
