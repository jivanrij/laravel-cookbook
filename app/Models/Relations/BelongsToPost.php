<?php

namespace App\Models\Relations;

use App\Models\Post;

trait BelongsToPost
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
