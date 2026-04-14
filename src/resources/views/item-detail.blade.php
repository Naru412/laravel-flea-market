@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
@endsection

@section('content')

<div class="item-container">
    <!-- 左画像　-->
    <div class="image">
        <div class="image-box">
             @if(Str::startsWith($item->image,'http'))
                <img src="{{ $item->image }}">
            @else
                <img src="{{ asset('storage/'.$item->image) }}">
            @endif
        </div>
    </div>    

    <!-- 右商品情報-->
    <div class="detail">
        <h1>{{ $item->name }}</h1>
        <p class="brand">{{ $item->brand }}</p>
        <p class="price">￥{{ number_format($item->price) }}（税込み）</p>

        @auth
        @php
        $liked = $item->likes->where('user_id', auth()->id())->count();
        @endphp

        <form action="/like/{{ $item->id }}" method="POST">
            @csrf
            <button type="submit" class="like-btn">
                <img src="{{ asset($liked ? 'images/heart-red.png' : 'images/heart.png') }}" alt="like">
                {{ $item->likes->count() }}
            </button>
        </form>
        @endauth

        <a href="/purchase/{{ $item->id }}" class="buy-btn">購入手続きへ</a>

        <h2>商品説明</h2>
        <p>{{ $item->description }}</p>

        <h2>商品の情報</h2>
        <p>
            カテゴリー:
            @foreach($item->categories as $category)
                {{ $category->name }}
            @endforeach
        </p>
        <p>商品の状態: {{ $item->condition }}</p>

        <h2>コメント（{{ $item->comments->count() }}）</h2>
        @foreach($item->comments as $comment)
            <p>
                <strong>{{ $comment->user->name }}</strong>：
                {{ $comment->content }}
            </p>
        @endforeach

        @auth
        <h3>コメントを書く</h3>
        <form action="/comment/{{ $item->id }}" method="POST">
            @csrf
            <textarea name="content"></textarea>

            @error('content')
                <p style="color:red;">{{ $message }}</p>
            @enderror
            
            <button class="comment-btn">コメントを送信する</button>
        </form>
        @endauth
    </div>
</div>
@endsection

