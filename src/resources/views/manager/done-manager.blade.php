@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/done.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="done">
    <div class="done-top">完了しました</div>
    <a class="btn btn-back" href="/manager">トップに戻る</a>
</div>
@endsection('content')