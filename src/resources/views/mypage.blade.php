@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
<h1 class="like-username">{{ auth()->user()->name }}さん</h1>
<div class="mypage">
    <div class="reservation">
        <div class="reservation-top">予約状況</div>
        <div class="reservation-card">
            @foreach ($reservations as $reservation)
                <div class="reservation-card_body">
                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="close-btn"><i class="fa fa-times-circle"></i></button>
                    </form>
                    <div class="reservation-card_title">
                        <i class="fa fa-clock-o"></i> 予約{{ $loop->iteration }}
                    </div>
                    <p>Shop: {{ $reservation->restaurant->restaurant_name }}</p>
                    <p>Date: {{ $reservation->reservation_date }}</p>
                    <p>Time: {{ $reservation->reservation_time }}</p>
                    <p>Number: {{ $reservation->guest_count }}人</p>
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn-edit">変更</a>
                    <a href="{{ route('reservations.qrcode', $reservation->id) }}" target="_blank" class="btn-qrcode">QRコード</a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="like">
        <div class="like-top">お気に入り店舗</div>
        <div class="like-card">
            @foreach ($favoriteRestaurants as $restaurant)
                <div class="card">
                    <img src="{{ filter_var($restaurant->photo_url, FILTER_VALIDATE_URL) ? $restaurant->photo_url : Storage::url($restaurant->photo_url) }}" class="card-img-top" alt="{{ $restaurant->restaurant_name }}">
                    <div class="card-body">
                        <h2 class="card-title">{{ $restaurant->restaurant_name }}</h2>
                        <p class="card-text">
                            ＃{{ $restaurant->area->area_name }}
                            ＃{{ $restaurant->genre->genre_name }}
                        </p>
                        <a href="{{ route('shop_detail', $restaurant->id) }}" class="btn-primary">詳しく見る</a>
                        <form action="{{ route('like.toggle') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                            <button type="submit" class="btn btn-heart">
                                @if (Auth::user()->hasLiked($restaurant->id))
                                    <i class="fa fa-heart text-danger"></i>
                                @else
                                    <i class="fa fa-heart"></i>
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection('content')