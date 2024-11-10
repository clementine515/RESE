<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\CreateReservationRequest;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class ReservationController extends Controller
{
    public function create($restaurantId)
    {
        return view('shop_detail', ['restaurantId' => $restaurantId]);
    }

        public function store(CreateReservationRequest $request)
    {
        $validated = $request->validated();

        Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $request->input('restaurant_id'),
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'guest_count' => $validated['guest_count'],
            'menu' => $request->input('menu'),
        ]);

        if ($request->filled('menu')) {
            return redirect()->route('stripe.payment', ['menu' => $request->input('menu')]);
        }

        return redirect()->route('done');
    }


    public function myPage()
    {
        $user = auth()->user();
        $reservations = $user->reservations()->whereDate('reservation_date', '>=', now()->toDateString())->get();
        $favoriteRestaurants = $user->favoriteRestaurants()->get();

        return view('mypage', compact('reservations', 'favoriteRestaurants'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('mypage');
    }

    public function visitHistory()
    {
        $user = auth()->user();
        $pastReservations = $user->reservations()
            ->where('reservation_date', '<=', now()->toDateString())
            ->whereRaw("TIMESTAMP(reservation_date, reservation_time) <= DATE_SUB(NOW(), INTERVAL 1 HOUR)")
            ->get();

        $restaurants = Restaurant::all();

        return view('review_form', [
            'reservation' => $pastReservations->first(),
            'restaurants' => $restaurants,
        ]);
    }

    public function showReviewForm($restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);

        return view('review_form', compact('restaurant'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $restaurant = $reservation->restaurant;

        return view('reservation-edit', compact('reservation', 'restaurant'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validatedData = $request->validate([
            'reservation_date' => 'required|date|after:now',
            'reservation_time' => 'required|date_format:H:i',
            'guest_count' => 'required|integer|min:1|max:10',
            'menu' => 'nullable|string',
        ]);

        $reservation->update($validatedData);

        if ($request->filled('menu')) {
            return redirect()->route('stripe.payment', ['menu' => $request->input('menu')]);
        }

        return redirect()->route('mypage');
    }

    public function checkReservation()
    {
        $managerId = Auth::id();
        $restaurants = Restaurant::where('manager_id', $managerId)->pluck('id')->toArray();
        $reservations = Reservation::whereIn('restaurant_id', $restaurants)
            ->where('reservation_date', '>=', Carbon::today())
            ->orderBy('reservation_date', 'asc')
            ->orderBy('reservation_time', 'asc')
            ->with(['user', 'restaurant'])
            ->get();

        return view('manager/check-reservation', compact('reservations'));
    }

    public function generateQRCode($id)
    {
        $reservation = Reservation::findOrFail($id);
        $user = $reservation->user;
        $restaurant = $reservation->restaurant;

        $data = "ユーザー名: {$user->name}\n"
            . "レストラン名: {$restaurant->name}\n"
            . "予約日程: {$reservation->reservation_date}\n"
            . "予約時間: {$reservation->reservation_time}\n"
            . "予約人数: {$reservation->guest_count}人";

        $qrCode = new QrCode($data);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return response($result->getString())->header('Content-Type', 'image/png');
    }


}
