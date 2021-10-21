<?php

namespace App\Services;

use App\Models\Post;

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
        return Post::with(['user:id,name', 'user.personalInfo:title'])->limit(5)->get();
    }
}
