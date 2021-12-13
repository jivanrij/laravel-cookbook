<?php

namespace App\Models\Relations;

use App\Models\Image;

trait MorphedByManyImagesOnTaggable
{
    public function images()
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }
}
