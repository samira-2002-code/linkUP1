<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Show the feed with all posts, newest first.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('feed', compact('posts'));
    }
 
}
