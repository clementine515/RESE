@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/manager.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="manager">
    <div class="manager-top">{{ auth()->user()->name }}さん、こんにちは！</br>（店舗代表者専用の画面）</div>
    <ul class="manager-list">
        <li class="manager-item"><a href="/manager/choose-shop">店舗情報を編集する</a></li>
        <li class="manager-item"><a href="/manager/create-shop">新規店舗を登録する</a></li>
        <li class="manager-item"><a href="/manager/check-shop">予約状況を確認する</a></li>
            <form action="/logout" method="post">
                @csrf
                <button class="header-nav__button">Logout</button>
            </form>
        </li>
    </ul>
</div>
@endsection('content')