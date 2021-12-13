<?php

namespace App\Models\Relations;

use App\Models\Post;

trait HasManyPosts
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
