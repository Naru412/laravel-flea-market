@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')

@php
use Illuminate\Support\Str;
@endphp

<div class="mypage">
    <div class="profile-header">
        <div class="profile-left">
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" class="profile-image">
            @else
                <div class="profile-image default"></div>
            @endif

            <h2>{{ $user->name }}</h2>
        </div>
        <a href="/mypage/profile" class="edit-btn">プロフィールを編集</a>
    </div>

    <div class="tab-menu">
        <a href="/mypage?tab=sell"
           class="{{ request('tab', 'sell') == 'sell' ? 'active' : '' }}">
           出品した商品
        </a>

        <a href="/mypage?tab=buy"
           class="{{ request('tab') == 'buy' ? 'active' : '' }}">
           購入した商品
        </a>
    </div>

    <div class="item-list">

        {{-- 出品商品 --}}
         @if(request('tab', 'sell') == 'sell')

            @foreach($items as $item)
                <div class="item-card">

                    @if(Str::startsWith($item->image, 'http'))
                        <img src="{{ $item->image }}">
                    @else
                        <img src="{{ asset('storage/' . $item->image) }}">
                    @endif

                    <p>{{ $item->name }}</p>
                </div>
            @endforeach

        @endif

        {{-- 購入商品 --}}
        @if(request('tab') == 'buy')

            @foreach($purchases as $purchase)
                <div class="item-card">

                    @if(Str::startsWith($purchase->item->image, 'http'))
                        <img src="{{ $purchase->item->image }}">
                    @else
                        <img src="{{ asset('storage/' . $purchase->item->image) }}">
                    @endif

                    <p>{{ $purchase->item->name }}</p>
                </div>
            @endforeach

        @endif
    </div>
</div>
@endsection    