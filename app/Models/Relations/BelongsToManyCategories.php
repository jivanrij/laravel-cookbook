<?php

namespace App\Models\Relations;

use App\Models\Category;

trait BelongsToManyCategories
{
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
