@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('menu-btn')
<input type="checkbox" id="overlay-input" />
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
<div id="overlay">
    <label for="overlay-input" id="close-button">&times;</label>
    <ul>
        <li><a href="/toppage_logged_in">Home</a></li>
        <li>
            <form action="/logout" method="post">
                @csrf
                <button class="header-nav__button">Logout</button>
            </form>
        </li>
        <li><a href="/mypage">Mypage</a></li>
    </ul>
</div>
@endsection('menu-btn')

@section('content')
<div class="shop-detail">
    <div class="restaurant">
        <div class="restaurant-top">
            <a href="{{ route('toppage_logged_in') }}" class="btn-back">＜</a>
            <p class="restaurant-name">{{ $restaurant->restaurant_name }}</p>
        </div>
        <img src="{{ Storage::url($restaurant->photo_url) }}" class="card-img-top" alt="{{ $restaurant->restaurant_name }}">
        <div class="restaurant-info">
            <p class="restaurant-text">
            <br>
            ＃{{ $restaurant->area->area_name }}
            ＃{{ $restaurant->genre->genre_name }}<br><br>
            {{ $restaurant->description }}
            </p>
        </div>
    </div>

    <form class="reservation-form" action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="form-top">予約</div>
        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
        @livewire('reservation-form', ['restaurant' => $restaurant])
        <button type="submit" class="btn btn-reservation">予約する</button>
    </form>
</div>
@endsection