<?php

namespace App\Models\Relations;

use App\Models\Tag;

trait MorphToManyTags
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
