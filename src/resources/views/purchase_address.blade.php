@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_address.css') }}">
@endsection

@section('content')

<form class="address-form" action="/purchase/address/{{ $item->id }}" method="POST">
    @csrf

    <input type="text" name="postcode" placeholder="郵便番号" value="{{ old('postcode') }}">
    @error('postcode')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    
    <input type="text" name="address" placeholder="住所" value="{{ old('address') }}">
    @error('address')
        <p style="color:red;">{{ $message }}</p>
    @enderror     

    <input type="text" name="building" placeholder="建物名">

    <button type="submit">変更する</button>
</form>
@endsection