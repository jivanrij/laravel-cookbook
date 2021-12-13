<?php

namespace App\Models\Relations;

trait BelongsToManyPosts
{
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
