<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        return view('manager.manager');
    }

    public function chooseShop()
    {
        $restaurants = Restaurant::where('manager_id', Auth::id())->get();

        return view('manager.choose-shop', compact('restaurants'));
    }

    public function editShop($id)
    {
        $restaurant = Restaurant::where('manager_id', Auth::id())->findOrFail($id);
        $areas = Area::all();
        $genres = Genre::all();

        return view('manager.edit-shop', compact('restaurant', 'areas', 'genres'));
    }

    public function updateShop(Request $request, $id)
    {
        $restaurant = Restaurant::where('manager_id', Auth::id())->findOrFail($id);

        $restaurant->update([
            'photo_url' => $request->input('photo_url'),
            'area_id' => $request->input('area'),
            'genre_id' => $request->input('genre'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('manager.done');
    }

    public function done()
    {
        return view('manager.done-manager');
    }

    public function showCreateShopForm()
    {
        $areas = Area::all();
        $genres = Genre::all();

        return view('manager.create-shop', compact('areas', 'genres'));
    }

    public function createShop(Request $request)
    {
        $managerId = Auth::id();

        Restaurant::create([
            'restaurant_name' => $request['restaurant_name'],
            'photo_url' => $request['photo_url'],
            'area_id' => $request['area'],
            'genre_id' => $request['genre'],
            'description' => $request['description'],
            'manager_id' => $managerId,
        ]);

        return redirect()->route('manager.done');
    }

    public function checkShop()
    {
        $restaurants = Restaurant::where('manager_id', Auth::id())->get();

        return view('manager.check-shop', compact('restaurants'));
    }

    public function checkReservation($restaurantId)
    {
        $restaurant = Restaurant::where('manager_id', Auth::id())->findOrFail($restaurantId);
        $reservations = Reservation::where('restaurant_id', $restaurantId)
        ->where('reservation_date', '>=', \Carbon\Carbon::today())
        ->get();

        return view('manager.check-reservation', compact('reservations', 'restaurant'));
    }
}
