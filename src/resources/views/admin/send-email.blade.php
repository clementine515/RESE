@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/send-email.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="send-email">
    <h1 class="title">メール送信</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="form" action="{{ route('admin.sendEmail') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="recipients">送信先:</label>
            <select id="recipients" name="recipients[]" class="form-control" multiple required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('recipients')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="subject">件名:</label>
            <input type="text" id="subject" name="subject" class="form-control" required>
            @error('subject')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="message">内容:</label>
            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
            @error('message')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">送信する</button>
    </form>
    <a class="btn btn-back" href="/admin">トップへ</a>
</div>
@endsection('content')