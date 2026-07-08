<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
  public function toggle(Post $post)
    {
        $like = Like::where('user_id', Auth::id())
                    ->where('post_id', $post->id)
                    ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);
        }

        return back();
    }
}
