<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    protected $model = Comment::class;


    public function definition()
    {
        return [
            'title' => ucfirst($this->faker->words(4, true)),
            'post_id' => Post::factory(),
            'user_id' => User::factory(),
        ];
    }
}
