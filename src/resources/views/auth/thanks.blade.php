@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css')}}">
@endsection

@section('menu-btn')
<input type="checkbox" id="overlay-input" />
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
<div id="overlay">
    <label for="overlay-input" id="close-button">&times;</label>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/register">Registration</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
</div>
@endsection('menu-btn')

@section('content')
<div class="thanks">
    <div class="thanks-text">会員登録ありがとうございます</br>メールアドレス認証後にログイン可能です</div>
    <a class="btn" href="/login" style="text-decoration:none">ログインする</a>

    <form action="{{ route('verification.resend') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">認証メールを再送する</button>
    </form>

</div>

@endsection('content')