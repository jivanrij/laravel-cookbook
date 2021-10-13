<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    protected $model = Comment::class;


    public function definition()
    {
        if (!Post::all()->count()) {
            Post::factory()->create();
        }

        return [
            'title' => ucfirst($this->faker->words(4, true)),
            'post_id' => Post::all()->random()->id
        ];
    }
}
