@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css')}}">
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
<div class="login-form">
    <h2 class="login-form__title">Login</h2>
    <div class="login-form__inner">
        <form class="login-form__form" action="/login" method="post">
            @csrf
            <div class="login-form__group">
                <span class="icon"><i class="fas fa-envelope"></i></span>
                <input class="login-form__input" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                <p style="color: red; font-weight: bold;">{{ $message }}</p>
                @enderror
            </div>
            <div class="login-form__group">
                <span class="icon"><i class="fas fa-lock"></i></span>
                <input class="login-form__input" type="password" name="password" id="password" placeholder="Password">
                @error('password')
                <p style="color: red; font-weight: bold;">{{ $message }}</p>
                @enderror
            </div>
            <div class="login-form__group login-form__button-group">
                <input class="login-form__btn btn" type="submit" value="ログイン" name="send">
            </div>
        </form>
    </div>
</div>
@endsection('content')
