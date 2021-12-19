<?php

namespace App\Models;

use App\Casts\UserFullNameCast;
use App\Models\Relations\HasManyComments;
use App\Models\Relations\HasManyPosts;
use App\Models\Relations\HasOnePersonalInfo;
use App\Models\Relations\MorphOneImage;
use App\Traits\CacheQueryBuilderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use CacheQueryBuilderTrait;
    use HasOnePersonalInfo;
    use HasManyPosts;
    use HasManyComments;
    use MorphOneImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'full_name' => UserFullNameCast::class,
    ];
}
