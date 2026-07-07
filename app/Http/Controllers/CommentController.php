<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(StoreCommentRequest $request, Post $post)
    {
        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return back()->with('success', 'Commentaire ajouté');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Commentaire supprimé');
    }
}