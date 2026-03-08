@extends('layouts.app')

@section('css')
<link href="{{asset('/css/auth.css')}}" rel="stylesheet" >
@endsection

@section('content')
<div class="register-container">
    <h2>会員登録</h2>

    <form mehtod="POST" action="/register">
        @csrf
        <input type="text" name="name" placeholder="ユーザー名">
        <input type="email" name="email" placeholder="メールアドレス">
        <input type="password" name="password" placeholder="パスワード">
        <input type="password" name="password_confirmation" placeholder="確認用パスワード">

        <button type="submit">登録する</button>
    </form>
    <a href="/login">ログインはこちら</a>
</div>
@endsection
