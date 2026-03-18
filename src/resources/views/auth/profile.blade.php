@extends('layouts.app')

@section('content')
<div class="profile-container">

    <h2>プロフィール設定</h2>

    <form method="POST" action="/profile/update" enctype="multipart/form-data">
        @csrf

        <div>
            <label>プロフィール画像</label>
            <input type="file" name="image">
        </div>

        <div>
            <label>ユーザー名</label>
            <input type="text" name="name">
        </div>

        <div>
            <label>郵便番号</label>
            <input type="text" name="postcode">
        </div>

        <div>
            <label>住所</label>
            <input type="text" name="address">
        </div>

        <div>
            <label>建物名</label>
            <input type="text" name="building">
        </div>

        <button type="submit">更新する</button>

    </form>

</div>
@endsection