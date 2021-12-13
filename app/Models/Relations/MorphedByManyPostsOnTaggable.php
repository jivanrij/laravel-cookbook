<?php

namespace App\Models\Relations;

use App\Models\Post;

trait MorphedByManyPostsOnTaggable
{
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
