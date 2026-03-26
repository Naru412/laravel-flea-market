<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('auth.profile');
    }

    public function update(Request $request)
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
}
