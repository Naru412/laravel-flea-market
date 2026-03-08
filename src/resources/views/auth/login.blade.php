@extends('layouts.app')

@section('css')
<link href="{{asset('/css/auth.css')}}" rel="stylesheet" >
@endsection

@section('content')
<div class="auth-container">
    <h2>ログイン</h2>
    <form method="POST" action="/login">
        @csrf
        <input type="email" name="email" placeholder="メールアドレス">
        <input type="password" name="password" placeholder="パスワード">
        <button type="submit">
            ログインする

        </button>
    </form>
    <a href="/register">会員登録はこちら</a>
</div>
@endsection