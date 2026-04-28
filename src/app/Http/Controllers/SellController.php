<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExhibitionRequest;


class SellController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('sell',compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('items','public');
        }

        $Item = Item::create([

        'name'=>$request->name,
        'brand'=>$request->brand ?? '',
        'description'=>$request->description,
        'price'=>$request->price,
        'condition'=>$request->condition,
        'user_id'=>auth()->id(),
        'image'=>$imagePath,
        ]);
        if($request->has('categories')){
        $Item->categories()->attach($request->categories);
        }
        return redirect('/');
    }
}
