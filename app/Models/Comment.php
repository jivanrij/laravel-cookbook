<?php

namespace App\Models;

use App\Models\Relations\BelongsToPost;
use App\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, BelongsToPost, BelongsToUser;
}
