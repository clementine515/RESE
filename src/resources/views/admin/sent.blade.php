@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/sent.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="sent">
    <div class="sent-top">メールの送信が完了しました</div>
    <a class="btn btn-back" href="/admin">トップに戻る</a>
</div>
@endsection('content')