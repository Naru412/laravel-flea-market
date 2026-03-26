@extends('layouts.app')

@section('css')
<link href="{{asset('/css/auth.css')}}" rel="stylesheet" >
@endsection

@section('content')
<div class="register-container">
    <h2>会員登録</h2>

    <form method="POST" action="/register" novalidate>
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" placeholder="ユーザー名">
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror

        <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror

        <input type="password" name="password" placeholder="パスワード">
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror

        <input type="password" name="password_confirmation" placeholder="確認用パスワード">

        <button type="submit">登録する</button>
    </form>
    <a href="/login">ログインはこちら</a>
</div>
@endsection
