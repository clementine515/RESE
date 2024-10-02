@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/visit-history.css') }}">
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
<div class="visit-history">
    <div class="visit-history_top">{{ auth()->user()->name }}さんの来店履歴</div>
    @foreach ($pastReservations as $reservation)
    <div class="reservation-card_body">
        <div class="reservation-card_title">
            <i class="fa fa-clock-o"></i> 予約{{ $loop->iteration }}
        </div>
        <p>Shop: {{ $reservation->restaurant->restaurant_name }}</p>
        <p>Date: {{ $reservation->reservation_date }}</p>
        <p>Time: {{ $reservation->reservation_time }}</p>
        <p>Number: {{ $reservation->guest_count }}人</p>

        <label class="btn-comment" for="popup{{ $reservation->id }}">口コミする</label>
        <input type="checkbox" id="popup{{ $reservation->id }}" class="popup-checkbox" />
        <div class="popup">
            <label for="popup{{ $reservation->id }}" class="popup-close">&times;</label>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <input type="hidden" name="restaurant_id" value="{{ $reservation->restaurant_id }}">
                <div class="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" id="star{{ $i }}-{{ $reservation->id }}" name="star" value="{{ $i }}" />
                        <label for="star{{ $i }}-{{ $reservation->id }}" class="star">&#9733;</label>
                    @endfor
                </div>
                <textarea name="comment" placeholder="コメントを入力してください"></textarea>
                <button type="submit" class="btn-submit">口コミ登録する</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection('content')
