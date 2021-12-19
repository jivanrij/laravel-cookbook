<?php

namespace App\Models;

use App\Models\Relations\BelongsToUser;
use App\Models\Relations\MorphOneImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory, BelongsToUser, MorphOneImage;

    public function scopeSearch($query, array $searchTerms = [])
    {

        // For each given term
        collect($searchTerms)->filter()->each(function ($term) use ($query) {

            $term = preg_replace('/[^A-Za-z0-9]/','', $term) . '%';
            $query->where(function ($query) use ($term) {

                // Results in two calls to the database resulting in fully using the indexes of last_name_normalised, first_name_normalised & title_normalised.
                $query->where('title_normalised', 'like', $term)
                    ->orWhereIn('user_id', User::query()
                        ->where('first_name_normalised', 'like', $term)
                        ->orWhere('last_name_normalised', 'like', $term)
                        ->pluck('id')
                    );

                // When using a Model in the orWhereIn Laravel uses a separate call to the database to get the id's.
                // This way both queries can make use of the indexes.
                // Because a sub query that queries a related table can't use the index on the field of that related table.

                // Results in one call to the database, not being able make use of the indexes of first_name and last_name
                // $query->where('title', 'like', $term)
                //     ->orWhereIn('user_id', function ($query) use ($term) {
                //         $query->select('id')
                //             ->from('users')
                //             ->where('first_name', 'like', $term)
                //             ->orWhere('last_name', 'like', $term);
                //     });

            });

        });

    }
}
