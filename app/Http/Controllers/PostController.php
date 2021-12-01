<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        // You can use the Laravel debugbar to check out the time of the queries.

        // Slow query because the field has no index.
        Post::orderBy('sub_title')->simplePaginate();
        // Fast query because the field has an index.
        Post::orderBy('title')->simplePaginate();

        // Bad: 16 statements, 9 ms
        $posts = Post::orderBy('created_at')->simplePaginate();
        foreach ($posts as $post) {
            $post->comments()->latest()->first()->created_at;
        }
        // Good: 1 statement, 2.5 ms
        Post::withLastCommentDateAsField()->orderBy('created_at')->simplePaginate();

        // Good: 2 statements, but returns the whole Comment model. 2.5 ms
        Post::withlastCommentAsModel()->orderBy('created_at')->simplePaginate();

        return view('laravel');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
