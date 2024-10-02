@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/choose-shop.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="choose-shop">
    <h1>どのお店を編集しますか？</h1>
    <ul style="list-style-type: none;">
        @foreach ($restaurants as $restaurant)
            <li>
                <a class="btn" href="{{ route('manager.editShop', $restaurant->id) }}">{{ $restaurant->restaurant_name }}</a>
            </li>
        @endforeach
    </ul>
    <a class="btn-back" href="/manager">トップへ</a>
</div>
@endsection('content')