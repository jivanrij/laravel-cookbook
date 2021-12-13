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

    public function scopeSearch($query, array $searchTerms = [])
    {
        // For each given term
        collect($searchTerms)->filter()->each(function ($term) use ($query) {

            // Don't put % before the search term, this prevents the database from using the indexes.
            // Because it's possible to search on 'This is "foo bar"' resulting in 'foo bar' being one term
            // this will probably be no issue.
            $term = $term . '%';

            // Add the following to the query

            // Wrap all parts within parentheses for each term
            $query->where(function ($query) use ($term) {

                // Query fields in base model and load and query relation
//                $query->where(function($query) use ($term) {
//                    // Query fields in base model and load and query relation
//                    $query->where('first_name', 'like', $term)
//                        ->orWhere('last_name', 'like', $term)
//                        ->orWhereIn('id', function($query) use ($term) {
//                            $query->select('user_id')
//                                ->from('personal_infos')
//                                ->where('title', 'like', $term);
//                        });
//                });

                $query->where(function ($query) use ($term) {
                    // Query fields in base model and load and query relation
                    $query->where('title', 'like', $term)
                        ->orWhereIn('user_id', function ($query) use ($term) {
                            $query->select('id')
                                ->from('users')
                                ->where('first_name', 'like', $term)
                                ->orWhere('last_name', 'like', $term);
                        });
                });

            });
        });

//        The query below is the result of searching for terms 'foo' and 'bar'
//        select * from `users` where (
//            `first_name` like '%foo%' or `last_name` like '%foo%' or
//                exists (select * from `personal_infos` where `users`.`id` = `personal_infos`.`user_id` and `title` like '%foo%')
//            )
//        and (`first_name` like '%bar%' or `last_name` like '%bar%' or
//                exists (select * from `personal_infos` where `users`.`id` = `personal_infos`.`user_id` and `title` like '%bar%')
//        )

    }
}
