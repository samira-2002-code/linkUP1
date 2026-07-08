<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])
            ->withCount('comments', 'likes')
            ->latest()
            ->get();

        return view('feed', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        Post::create([
            'content' => $request->validated()['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('feed');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update([
            'content' => $request->validated()['content'],
        ]);

        return redirect()->route('feed');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('feed');
    }
}






