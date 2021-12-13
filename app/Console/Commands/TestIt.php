<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\PersonalInfo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;

class TestIt extends Command
{
    protected $signature = 'testit';

    protected $description = 'Test code';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        User::factory()
            ->has(PersonalInfo::factory())
            ->has(Post::factory()->count(5))
            ->has(Comment::factory()->count(5))
            ->has(Image::factory())
            ->create();

        Post::factory()
            ->has(Image::factory()->count(5))
            ->has(Comment::factory())
            ->for(User::factory())
            ->has(Tag::factory()->count(5))
            ->has(Category::factory()->count(5))
            ->create();

        Tag::factory()->hasAttached(
            Image::factory()->for(
                Post::factory(), 'imageable'
            )
        )->create();


        ray(PersonalInfo::count());
        ray(Comment::count());
        ray(Image::count());
        ray(User::count());
        ray(Tag::count());
        ray(Category::count());
        ray(Post::count());
    }
}
