@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/all_review.css') }}">
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
<div class="restaurant">
    <h2>{{ $restaurant->restaurant_name }}の全ての口コミ情報</h2>
    <p>＃{{ $restaurant->area->area_name }} ＃{{ $restaurant->genre->genre_name }}</p>
    <hr>

    @forelse ($reviews as $review)
        <div class="review">
            <p class="user-star">
                @for ($i = 0; $i < $review->star; $i++)
                    <i class="fa fa-star text-primary"></i>
                @endfor
                @for ($i = $review->star; $i < 5; $i++)
                    <i class="fa fa-star text-secondary"></i>
                @endfor
            </p>
            <p class="user-comment">{{ $review->comment }}</p>
            @if ($review->photo)
                <img src="{{ Storage::url($review->photo) }}" alt="クチコミ写真" class="review-photo">
            @endif

            @if(auth()->user()->isAdmin())
            <form action="{{ route('admin.review.destroy', ['review_id' => $review->id]) }}" method="get" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
            @endif

            <hr>
        </div>
    @empty
        <p>口コミはまだありません。</p>
    @endforelse

    <a href="{{ route('shop_detail', ['shop_id' => $restaurant->id]) }}" class="btn-back">戻る</a>
</div>
@endsection('content')