<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
//編集画面表示
    public function edit()
    {
        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }

//プロフィールを保存
    public function update(ProfileRequest $request)
    {

        $user = auth()->user();

        $user->name = $request->name;
        $user->postal = $request->postal;
        $user->address = $request->address;
        $user->building = $request->building;

        if($request->hasFile('image')){

        $path = $request->file('image')->store('profile','public');

        $user->image = $path;
        }

        $user->save();

        return redirect('/');
    }

//マイページ表示
    public function show()
    {
    $user = auth()->user();
    $items = $user->items;
    $purchases = $user->purchases()->with('item')->get();


    return view('auth.show', compact('user', 'items', 'purchases'));
    }
}
