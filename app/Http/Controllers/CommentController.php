<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentsResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        return CommentsResource::collection($post->comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post,CommentRequest $request)
    {
        $req = new Comment;
        $req->post_id = $post->id;
        $req->name = $request->name;
        $req->description = $request->description;
        $req->save();
        return new CommentResource($req);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post,Comment $comment)
    {
        if($comment->post_id === $post->id)
        {
            return new CommentResource($comment);
        }
        else
        {
            return null;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, Request $request,Comment $comment)
    {
        $comment->update($request->all());
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post,Comment $comment)
    {
        if($post->id == $comment->post_id)
        {
            $comment->delete();
            return new CommentResource($comment);
        }
        else
        {
            return 'no comment with this id in this post';
        }
    }
}
