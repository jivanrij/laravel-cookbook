<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
    ];

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
    public function scopeWithLastCommentDateAsField($query)
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


    /**
     * Dynamic relation example.
     *
     * Fake a relation on a model. In this case, a relation to the last created comment of this post.
     *
     * $this->lastComment() Tells Laravel that there is a belongsTo relation that returns a Comment model.
     * Due to this Laravel expects a field called last_comment_id on the Post model.
     * With $this->scopeWithlastCommentAsModel($query) we can add this to the model's query simply by putting an
     * 'addSelect' on the query that returns the 'last_comment_id' field with the correct id. Also add the relation
     * 'lastComment' in a 'with' so the extra models get loaded.
     *
     * This takes up a bit more memory then $this->scopeWithLastCommentDateAsField($query) but results in being able
     * to work with the whole model instead of one specific value.
     */
    public function lastComment()
    {
        return $this->belongsTo(Comment::class);
    }
    public function scopeWithlastCommentAsModel($query)
    {
        $query->addSelect(['last_comment_id' => Comment::select('id')
                ->whereColumn('post_id', 'posts.id')
                ->latest()
                ->take(1)
        ])->with('lastComment');
    }

}
