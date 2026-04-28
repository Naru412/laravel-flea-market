@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<div class="sell-container">
<h2 class="sell-title">商品の出品</h2>
<form action="/sell" method="POST" enctype="multipart/form-data">
@csrf
<div class="image-box">
<p class="section-title">商品画像</p>

<label class="image-upload">
<input type="file" name="image">
<span>画像を選択する</span>
</lavel>
@error('image')
<p class="error-message">{{ $message }}</p>
@enderror

</div>

<hr>

<div>
<p class="section-title">商品の詳細</p>
<p>カテゴリ</p>

<div class="category-group">
@foreach($categories as $category)
<label class="category-label">
    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
    <span>{{ $category->name}}</span>
</label>
@endforeach
</div>

@error('categories')
<p class="error-message">{{ $message }}</p>
@enderror

<p>商品の状態</p>
<select class="form-input" name="condition">
<option>選択してください</option>
<option>良好</option>
<option>目立った汚れや傷なし</option>
<option>やや傷や汚れあり</option>
<option>状態が悪い</option>
</select>
@error('condition')
<p class="error-message">{{ $message }}</p>
@enderror
</div>

<hr>

<p class="section-title">商品名と説明</p>
<p>商品名</p>
<input class="form-input" type="text" name="name" value="{{ old('name') }}">
@error('name')
<p class="error-message">{{ $message }}</p>
@enderror

<p>ブランド名</p>
<input class="form-input" type="text" name="brand" value="{{ old('brand') }}">
@error('brand')
<p class="error-message">{{ $message }}</p>
@enderror

<p>商品の説明</p>
<textarea class="form-input" name="description">{{ old('description') }}</textarea>
@error('description')
<p class="error-message">{{ $message }}</p>
@enderror

<p>販売価格</p>
<input class="form-input" type="number" name="price" value="{{ old('price') }}">
@error('price')
<p class="error-message">{{ $message }}</p>
@enderror

<button class="sell-button" type="submit">
出品する
</button>
</form>
</div>
@endsection