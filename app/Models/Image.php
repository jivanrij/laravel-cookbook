<?php

namespace App\Models;

use App\Models\Relations\MorphToManyTags;
use App\Models\Relations\MorphToImageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, MorphToImageable, MorphToManyTags;
}
