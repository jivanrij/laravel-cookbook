<?php

namespace App\Models\Relations;

use App\Models\Comment;

trait HasManyComments
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
