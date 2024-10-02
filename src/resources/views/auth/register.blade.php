@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
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
<div class="register-form">
    <h2 class="register-form__title">Registration</h2>
    <div class="register-form__inner">
        <form class="register-form__form" action="/register" method="post">
            @csrf
            <div class="register-form__group">
                <span class="icon"><i class="fas fa-user"></i></span>
                <input class="register-form__input" type="text" name="name" id="name" placeholder="Username" value="{{ old('name') }}">
                @error('name')
                <p style="color: red; font-weight: bold;">{{ $message }}</p>
                @enderror
            </div>
            <div class="register-form__group">
                <span class="icon"><i class="fas fa-envelope"></i></span>
                <input class="register-form__input" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                <p style="color: red; font-weight: bold;">{{ $message }}</p>
                @enderror
            </div>
            <div class="register-form__group">
                <span class="icon"><i class="fas fa-lock"></i></span>
                <input class="register-form__input" type="password" name="password" id="password" placeholder="Password">
                @error('password')
                <p style="color: red; font-weight: bold;">{{ $message }}</p>
                @enderror
            </div>
            <div class="register-form__group register-form__button-group">
                <input class="register-form__btn btn" type="submit" value="登録" name="send">
            </div>
        </form>
    </div>
</div>
@endsection('content')