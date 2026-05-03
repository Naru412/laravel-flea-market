@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

<form action="/purchase/{{ $item->id }}" method="POST">
    @csrf
        <div class="purchase-container">

            <!-- 左 -->
            <div class="left">
                @if(Str::startsWith($item->image,'http'))
                <img src="{{ $item->image }}">
                @else
                <img src="{{ asset('images/'.$item->image) }}">
                @endif

                <h2>{{ $item->name }}</h2>
                <p>¥{{ number_format($item->price) }}</p>
            </div>

    <!-- 中 -->
        <div class="center">
            <h3>支払い方法</h3>
            <select name="payment_method" id="payment-select">
                <option value="">選択してください</option>
                <option value="konbini">コンビニ支払い</option>
                <option value="card">カード支払い</option>
            </select>
            @error('payment_method')
                <p style="color:red;">{{ $message }}</p>
            @enderror

            <h3>配送先</h3>
            <p>〒{{ session('postcode') ?? auth()->user()->postcode }}</p>
            <p>{{ session('address') ?? auth()->user()->address }}</p>
            <p>{{ session('building') ?? auth()->user()->building }}</p>
            <a href="/purchase/address/{{ $item->id }}">住所変更</a>
        </div>

        <!-- 右 -->
        <div class="right">
            <div class="summary">
                <p>商品代金 ¥{{ number_format($item->price) }}</p>
                <p id="payment-text">支払い方法 コンビニ払い</p>
            </div>
            <button type="submit" class="purchase-btn">購入する</button>
        </div>
    </div>
</form>

<script>
const select = document.getElementById('payment-select');
const text = document.getElementById('payment-text');

function updatePaymentText() {
    if(select.value === 'convenience'){
        text.textContent = '支払い方法 コンビニ支払い';
    }else if(select.value === 'card'){
        text.textContent = '支払い方法 カード支払い';
    }else{
        text.textContent = '支払い方法 選択してください';
    }
}

updatePaymentText(); // 初期表示時

select.addEventListener('change', updatePaymentText);
</script>
@endsection