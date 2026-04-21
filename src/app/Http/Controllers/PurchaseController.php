<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase; 
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Http\Requests\PurchaseAddressRequest;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    public function create(Item $item)
    {
        $user = Auth::user();
        return view('purchase', compact('item', 'user'));
    }

    public function store(PurchaseRequest $request, Item $item)
    {
        $user = auth()->user();
            Stripe::setApiKey(env('STRIPE_SECRET'));
            // 支払い方法分岐
            if ($request->payment_method === 'card') {
                $methods = ['card'];
            } else {
                $methods = ['konbini'];
            }

        $session = StripeSession::create([
            'payment_method_types' => $methods,

            'line_items' => [[
                'price_data' => 
                [
                'currency' => 'jpy',
                'product_data' => ['name' => $item->name,],
                'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => url('/purchase/success/'.$item->id),
            'cancel_url' => url('/purchase/'.$item->id),
        ]);

            // ここではまだDB保存しない
        session([
            'purchase_item_id' => $item->id,
            'payment_method' => $request->payment_method,
        ]);

        return redirect($session->url);
    }
    
    public function editAddress(Item $item)
    {
    return view('purchase_address', compact('item'));
    }

    public function success(Item $item)
    {
            $user = auth()->user();

            Purchase::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'payment_method' => session('payment_method'),
                'postcode' => session('postcode') ?? $user->postal,
                'address' => session('address') ?? $user->address,
                'building' => session('building') ?? $user->building,
            ]);

            return redirect('/')->with('message', '購入完了しました');
    }

    public function updateAddress(PurchaseAddressRequest $request, Item $item)
    {
        // セッションに保存
        session([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect('/purchase/' . $item->id);
    }
}
