<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display all posts
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->with('user:id,name,image')->withCount('comments','likes')->get();
        return response(
            [
                'posts'=>$posts
            ],200 );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        // validate fields
    }

    /**
     * Display the specific post.
     */
    public function show(string $id): Response
    {
        $post=Post::where('id',$id)->withCount('comments','likes')->get();
        return response(
            [
                'post'=>$post
            ],200 );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        //
    }
}
