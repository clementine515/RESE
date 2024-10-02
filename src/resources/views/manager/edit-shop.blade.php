@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/edit-shop.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="restaurant">
    <div class="restaurant-top">
        <p class="restaurant-name">{{ $restaurant->restaurant_name }}</p>
    </div>
    <form class="edit-form" action="{{ route('manager.updateShop', $restaurant->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="photo_url">写真URL:</label>
            <input type="text" id="photo_url" name="photo_url" value="{{ $restaurant->photo_url }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="area">エリア:</label>
            <select id="area" name="area" class="form-control" required>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ $restaurant->area_id == $area->id ? 'selected' : '' }}>
                        {{ $area->area_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="genre">ジャンル:</label>
            <select id="genre" name="genre" class="form-control" required>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $restaurant->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->genre_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">説明:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required>{{ $restaurant->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
    <a class="btn btn-back" href="/manager">トップへ</a>
</div>
@endsection('content')
