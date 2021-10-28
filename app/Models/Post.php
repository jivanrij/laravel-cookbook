<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Relations
     */

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scopes
     */

    /**
     * Scope that adds the last created comment's created_at field to the returned models.
     *
     * @param $query
     */
    public function scopeWithLastCommentDate($query)
    {
        // Adds a sub query that retreives the created_at value of the latest added related comment
        $query->addSelect([
            'last_comment_date' =>
                Comment::select('created_at')
                    ->whereColumn('post_id', 'posts.id')
                    ->latest()
                    ->take(1)
        ])
            ->withCasts(['last_comment_date' => 'datetime']); // and formats the time 
    }
}
