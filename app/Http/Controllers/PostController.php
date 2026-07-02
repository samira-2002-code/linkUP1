<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Feed (all posts)
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('feed', compact('posts'));
    }

    /**
     * Store a new post
     */
    public function store(StorePostRequest $request)
    {
        Post::create([
            'content' => $request->validated()['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('feed');
    }

    /**
     * Show edit form
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update post
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        return redirect()->route('feed');
    }

    /**
     * Delete post
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('feed');
    }
}