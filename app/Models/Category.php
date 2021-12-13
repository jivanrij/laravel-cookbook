<?php

namespace App\Models;

use App\Models\Relations\BelongsToManyPosts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, BelongsToManyPosts;
}
