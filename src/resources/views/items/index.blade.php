@extends('layouts.app')

@section('css')
<link href="{{asset('/css/index.css')}}" rel="stylesheet" >
@endsection

@section('content')

<div class="tab-area">

    <a href="/?tab=all">おすすめ</a>
    <a href="/?tab=mylist">マイリスト</a>

</div>

<div class="item-list">

@foreach($items as $item)

<div class="item-card">

    <div class="item-image">

        <img src="{{ asset($item->image) }}">

        @if($item->purchases->isNotEmpty())
        <div class="sold">Sold</div>
        @endif

    </div>

    <p class="item-name">
        {{ $item->name }}
    </p>

</div>

@endforeach

</div>

@endsection