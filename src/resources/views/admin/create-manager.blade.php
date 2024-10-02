@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/create-manager.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="create-manager">
    <h1 class="title">店舗代表者を作成する</h1>
    <form class="form" action="{{ route('admin.createManager') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="restaurant_id">店舗名:</label>
            <select id="restaurant_id" name="restaurant_id" class="form-control" required>
                <option value="" disabled selected>店舗を選択してください</option>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->restaurant_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">店舗代表者:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">登録する</button>
    </form>
    <a class="btn btn-back" href="/admin">トップへ</a>
</div>
@endsection
