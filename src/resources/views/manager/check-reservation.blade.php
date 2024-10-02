@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/check-reservation.css') }}">
@endsection

@section('menu-btn')
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
@endsection('menu-btn')

@section('content')
<div class="check-reservation">
    <h1 class="title">予約状況確認 - {{ $restaurant->restaurant_name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th class="table-item">レストラン名</th>
                <th class="table-item">予約者名</th>
                <th class="table-item">予約者のメアド</th>
                <th class="table-item">予約日程</th>
                <th class="table-item">予約時間</th>
                <th class="table-item">予約人数</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td class="table-content">{{ $reservation->restaurant->restaurant_name }}</td>
                    <td class="table-content">{{ $reservation->user->name }}</td>
                    <td class="table-content">{{ $reservation->user->email }}</td>
                    <td class="table-content">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y/m/d') }}</td>
                    <td class="table-content">{{ $reservation->reservation_time }}</td>
                    <td class="table-content">{{ $reservation->guest_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn-back" href="/manager">トップへ</a>
</div>
@endsection('content')