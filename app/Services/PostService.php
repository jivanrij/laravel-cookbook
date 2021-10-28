<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PostService
{
    public function getPostsWithAuthors()
    {
        // Get's all the Posts with the related User models through relation 'user'
        return Post::with('user')->get();
    }

    public function getPostsWithAuthorName()
    {
        // Get's all the Posts with only the related User id's and name's through relation 'user'
        return Post::with('user:id,name')->get();
    }

    public function getPostsWithAuthorNameAndTitle()
    {
        // Get's all the Posts with only the related User id's and name's through relation 'user' and the title
        // from the PersonalInfo model through the 'personalInfo' relation on the related User.
        // This reduces the memory used by this query.
        return Post::with(['user:id,name', 'user.personalInfo:title'])->limit(5)->get();
    }

    public function getPostsOfNewUsers()
    {
        // Get Posts with Users who have verified there accounts since yesterday.
        return Post::whereHas('user', function (Builder $query) {
            $query->where('email_verified_at', '>', Carbon::yesterday());
        })->get();

        // This can be combined with 'with' to eager load the users. Example:
        // return Post::with('user')->whereHas('user', function (Builder $query) {
        //     $query->where('email_verified_at', '>', Carbon::yesterday());
        // })->get();
    }
}
