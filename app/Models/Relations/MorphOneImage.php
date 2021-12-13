<?php

namespace App\Models\Relations;

use App\Models\Image;

trait MorphOneImage
{
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
