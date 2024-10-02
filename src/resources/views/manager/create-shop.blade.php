@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/create-shop.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="create-shop">
    <h1>新規店舗を作成する</h1>
    <form action="{{ route('manager.createShop') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="restaurant_name">店舗名:</label>
            <input type="text" id="restaurant_name" name="restaurant_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="photo_url">画像 URL:</label>
            <select id="photo_url" name="photo_url" class="form-control" required>
                <option value="" disabled selected>選択してください</option>
                <option value="photos/sushi.jpg">寿司(photos/sushi.jpg)</option>
                <option value="photos/yakiniku.jpg">焼肉(photos/yakiniku.jpg)</option>
                <option value="photos/izakaya.jpg">居酒屋(photos/izakaya.jpg)</option>
                <option value="photos/italian.jpg">イタリアン(photos/italian.jpg)</option>
                <option value="photos/ramen.jpg">ラーメン(photos/ramen.jpg)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="area">エリア:</label>
            <select id="area" name="area" class="form-control" required>
                <option value="" disabled selected>選択してください</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="genre">ジャンル:</label>
            <select id="genre" name="genre" class="form-control" required>
                <option value="" disabled selected>選択してください</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">店舗説明:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">新規店舗を作成する</button>
    </form>
    <a class="btn-back" href="/manager">トップへ</a>
</div>
@endsection('content')
