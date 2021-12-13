<?php

namespace App\Models;

use App\Models\Relations\MorphedByManyImagesOnTaggable;
use App\Models\Relations\MorphedByManyPostsOnTaggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, MorphedByManyImagesOnTaggable, MorphedByManyPostsOnTaggable;
}
