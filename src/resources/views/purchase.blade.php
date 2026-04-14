@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

<div class="purchase-container">

    <!-- 左 -->
    <div class="left">
        <img src="{{ asset('storage/'.$item->image) }}">
        <h2>{{ $item->name }}</h2>
        <p>¥{{ number_format($item->price) }}</p>
    </div>

    <!-- 中 -->
    <div class="center">
        <h3>支払い方法</h3>
        <select name="payment">
            <option>選択してください</option>
            <option value="convenience">コンビニ支払い</option>
            <option value="card">カード支払い</option>
        </select>

        <h3>配送先</h3>
        <p>〒{{ auth()->user()->postcode ?? 'XXX-YYYY' }}</p>
        <p>{{ auth()->user()->address ?? '住所が入ります' }}</p>
    </div>

    <!-- 右 -->
    <div class="right">
        <div class="summary">
            <p>商品代金 ¥{{ number_format($item->price) }}</p>
            <p>支払い方法 コンビニ払い</p>
        </div>

        <button class="purchase-btn">購入する</button>
    </div>

</div>

