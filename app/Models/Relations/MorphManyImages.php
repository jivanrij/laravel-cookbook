<?php

namespace App\Models\Relations;

use App\Models\Image;

trait MorphManyImages
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
