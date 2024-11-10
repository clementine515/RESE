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
        <div class="check-review">
            <a href="{{ route('reviews.all', ['restaurant_id' => $restaurant->id]) }}" class="btn-checkreview">全ての口コミ情報</a>
        </div>

        @if ($userReview)
        <div class="user-review">
            <div class="review-actions">
                <a href="{{ route('review.edit', ['id' => $userReview->id]) }}" class="btn-edit">口コミを編集</a>
                <form action="{{ route('review.delete', ['id' => $userReview->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？')">口コミを削除</button>
                </form>
            </div>

            <p class="user-star">
                @for ($i = 0; $i < $userReview->star; $i++)
                    <i class="fa fa-star text-primary"></i>
                @endfor
                @for ($i = $userReview->star; $i < 5; $i++)
                    <i class="fa fa-star text-secondary"></i>
                @endfor
            </p>
            <p class="user-comment">{{ $userReview->comment }}</p>
            @if ($userReview->photo)
                <img src="{{ Storage::url($userReview->photo) }}" alt="クチコミ写真" class="review-photo">
            @endif
        </div>
        @else
        <div class="make-review">
            <a href="{{ route('review-form', ['restaurant_id' => $restaurant->id]) }}" class="btn-review">口コミを投稿する</a>
        </div>
        @endif
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