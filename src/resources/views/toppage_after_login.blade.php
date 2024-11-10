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
<form class="sort-form" action="/search" method="get" id="sortForm">
    <select name="sort_order" class="search-form__sort-select" onchange="document.getElementById('sortForm').submit();">
        <option value="" {{ request('sort_order') == '' ? 'selected' : '' }}>並び替え：</option>
        <option value="random" {{ request('sort_order') == 'random' ? 'selected' : '' }}>並び替え：ランダム</option>
        <option value="high_rating" {{ request('sort_order') == 'high_rating' ? 'selected' : '' }}>並び替え：評価が高い順</option>
        <option value="low_rating" {{ request('sort_order') == 'low_rating' ? 'selected' : '' }}>並び替え：評価が低い順</option>
    </select>
</form>

<form class="search-form" action="/search" method="get">
    @csrf
    <div class="search-form__area">
        <select class="search-form__area-select" id="area" name="area">
            <option value="">All area</option>
            @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="search-form__genre">
        <select class="search-form__genre-select" id="genre" name="genre">
            <option value="">All genre</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="search-form__word">
        <span class="icon"><i class="fa fa-search"></i></span>
        <input class="search-form__keyword-input" type="text" name="keyword" placeholder="Search ..." value="{{request('keyword')}}">
    </div>

    <div class="search-form__actions">
        <input class="search-form__search-btn btn" type="submit" value="Go">
    </div>
</form>

<div class="toppage">
    <div class="shop-row">
        @foreach ($restaurants as $restaurant)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ Storage::url($restaurant->photo_url) }}" class="card-img-top" alt="{{ $restaurant->restaurant_name }}">
                <div class="card-body">
                    <div class="card-title">{{ $restaurant->restaurant_name }}</div>
                    <p class="card-text">
                        ＃{{ $restaurant->area->area_name }}
                        ＃{{ $restaurant->genre->genre_name }}
                    </p>
                    <a href="{{ route('shop_detail', ['shop_id' => $restaurant->id]) }}" class="btn-primary">詳しく見る</a>
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
        </div>
        @endforeach
    </div>
</div>
@endsection('content')