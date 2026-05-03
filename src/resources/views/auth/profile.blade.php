@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/proflie.css') }}">
@endsection

@section('content')
<div class="profile-container">

    <h2>プロフィール設定</h2>

    <form method="POST" action="/mypage/profile/" enctype="multipart/form-data">
        @csrf

        <div>
            <label>プロフィール画像</label>
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" class="profile-image">
            @endif
            <input type="file" name="image">
            @error('image')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>郵便番号</label>
            <input type="text" name="postal" value="{{ old('postal', $user->postcode) }}">
            @error('postal')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>住所</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}">
            @error('address')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>建物名</label>
            <input type="text" name="building" value="{{ old('building', $user->building) }}">
        </div>

        <button type="submit">更新する</button>

    </form>

</div>
@endsection