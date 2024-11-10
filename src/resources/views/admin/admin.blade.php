@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="admin">
    <div class="admin-top">{{ auth()->user()->name }}さん、こんにちは！</br>（管理者専用の画面）</div>
        <ul class="admin-list">
            <li class="admin-item"><a href="/admin/create-manager">店舗代表者を作成する</a></li>
            <li class="admin-item"><a href="/admin/send-email">メールを送る</a></li>
            <li class="admin-item"><a href="{{ route('toppage_after_login') }}">口コミを管理する</a></li>
            <li class="admin-item"><a href="{{ route('admin.csvImportForm') }}">新規店舗追加（csvインポート）</a></li>
            <li class="admin-item">
                <form action="/logout" method="post">
                    @csrf
                    <button class="header-nav__button">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
@endsection('content')