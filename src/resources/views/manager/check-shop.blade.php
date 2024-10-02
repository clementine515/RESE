@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/choose-shop.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="choose-shop">
    <h1 class>どのお店の予約状況を確認しますか？</h1>
    <ul style="list-style-type: none;">
        @foreach ($restaurants as $restaurant)
            <li>
                <a class="btn" href="{{ route('manager.checkReservation', ['restaurantId' => $restaurant->id]) }}">{{ $restaurant->restaurant_name }}</a>
            </li>
        @endforeach
    </ul>
    <a class="btn-back" href="/manager">トップへ</a>
</div>
@endsection('content')