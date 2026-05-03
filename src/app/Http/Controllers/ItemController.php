<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
   public function index(Request $request)
{
    $query = Item::with('purchases');

    // マイリスト
    if ($request->tab == 'mylist') {

        if (!auth()->check()) {
            return view('items.index', ['items' => collect()]);
        }

        $query->whereHas('likes', function ($q) {
            $q->where('user_id', auth()->id());
        });

    } else {
        // おすすめ（自分の商品を除外）
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }
    }

    // 検索（ここに統合する）
    if ($request->keyword) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    $items = $query->get();

    return view('items.index', compact('items'));
}

   public function show(Item $item)
    {
    $item->load(['categories', 'comments.user']);

    return view('item-detail', compact('item'));
    }

    public function store(Request $request, $item_id)
    {
    Comment::create([
        'content' => $request->content,
        'item_id' => $item_id,
        'user_id' => auth()->id(),
    ]);
    }
}

