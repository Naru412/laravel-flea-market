<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('purchases');
        if($request->tab == 'mylist'){
            if(!auth()->check()){
                $items = collect();
                return view('items.index', compact('items'));
            }else
            {
                $query->whereHas('likes', function($q){
                    $q->where('user_id', auth()->id());
                });
            }
        }else
        {
            $query->where('user_id','!=',auth()->id());
        }
        if($request->keyword){
             $query->where('name','like','%'.$request->keyword.'%');
        }
        $items = $query->get();
        return view('items.index', compact('items'));
    }
}
