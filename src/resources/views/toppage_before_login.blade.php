@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/toppage.css')}}">
@endsection

@section('menu-btn')
<input type="checkbox" id="overlay-input" />
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
<div id="overlay">
    <label for="overlay-input" id="close-button">&times;</label>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/register">Registration</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
</div>
@endsection('menu-btn')

@section('content')
<div class="toppage">
    <div class="shop-row">
        @foreach ($restaurants as $restaurant)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ filter_var($restaurant->photo_url, FILTER_VALIDATE_URL) ? $restaurant->photo_url : Storage::url($restaurant->photo_url) }}" class="card-img-top" alt="{{ $restaurant->restaurant_name }}">
                <div class="card-body">
                    <div class="card-title">{{ $restaurant->restaurant_name }}</div>
                    <p class="card-text">
                        ＃{{ $restaurant->area->area_name }}
                        ＃{{ $restaurant->genre->genre_name }}
                    </p>
                    <a href="{{ route('shop_detail', $restaurant->id) }}" class="btn-primary">詳しく見る</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection('content')