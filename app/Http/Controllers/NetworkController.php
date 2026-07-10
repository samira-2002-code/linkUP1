<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NetworkController extends Controller
{
    public function toggle(User $user)
    {
        // Empêcher de se suivre soi-même
        if ($user->id == Auth::id()) {
            return back();
        }

        $follow = Follow::where('user_id', $user->id)
                        ->where('follower_id', Auth::id())
                        ->first();

        if ($follow) {
            // Unfollow
            $follow->delete();
        } else {
            // Follow
            Follow::create([
                'user_id' => $user->id,
                'follower_id' => Auth::id(),
            ]);
        }

        return back();
    }
}