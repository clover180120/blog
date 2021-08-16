<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentDestroyRequest;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CommentStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request, Post $post)
    
    {
        $comment = Comment::make($request->all());
        $comment->user_id = $request->user()->id;

        return $post->comments()->save($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentUpdateRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->update($request->all());
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\CommentDestroyRequest  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentDestroyRequest $request, Comment $comment)
    {
        $comment->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
