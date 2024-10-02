@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
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
<div class="done">
    <div class="done-text">
        ご予約ありがとうございます
    </div>
    <a href="{{ route('mypage') }}" class="btn-back">戻る</a>
</div>

@endsection('content')