<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function toggle(Item $item)
     {
    $user = Auth::user();
    $like = Like::where('user_id', $user->id)->where('item_id', $item->id) ->first();

    if ($like) {
        // 解除
        $like->delete();
    } else {
        // いいね
        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
    return back();
}
}
