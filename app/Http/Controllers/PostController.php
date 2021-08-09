<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostDestroyRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        return $request->user()->posts()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostUpdateRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\PostDestroyRequest  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostDestroyRequest $request, Post $post)
    {
        $post->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
