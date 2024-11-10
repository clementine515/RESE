@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/csv-import.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="container">
    <h2>店舗情報CSVインポート</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.importCsv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="csv_file">CSV ファイルを選択</label>
            <input type="file" name="csv_file" id="csv_file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">インポート</button>
    </form>
    <a class="btn btn-back" href="/admin">トップ</a>
</div>
@endsection('content')