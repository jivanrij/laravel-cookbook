<?php

namespace Tests;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\PersonalInfo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class EloquentRelationsTest extends TestCase
{
    public function test_model_relations()
    {
        $personalInfoCount = PersonalInfo::count();
        $commentCount = Comment::count();
        $imageCount = Image::count();
        $userCount = User::count();
        $tagCount = Tag::count();
        $categoryCount = Category::count();
        $postCount = Post::count();

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

        $this->assertEquals(1 + $personalInfoCount, PersonalInfo::count());
        $this->assertEquals(6 + $commentCount, Comment::count());
        $this->assertEquals(7 + $imageCount, Image::count());
        $this->assertEquals($userCount, User::count());
        $this->assertEquals(6 + $tagCount, Tag::count());
        $this->assertEquals(5 + $categoryCount, Category::count());
        $this->assertEquals(12 + $postCount, Post::count());
    }
}
