<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Like;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class RestaurantController extends Controller
{
    public function beforeLogin()
    {
        $restaurants = Restaurant::with(['area', 'genre'])->get();
        return view('toppage_before_login', compact('restaurants'));
    }

    public function index()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $restaurants = Restaurant::with(['area', 'genre'])->get();
        return view('toppage_after_login', compact('restaurants', 'areas', 'genres'));
    }

    public function show($shop_id)
    {
        $restaurant = Restaurant::findOrFail($shop_id);
        return view('shop_detail', compact('restaurant'));
    }

    public function search(Request $request)
    {
        $query = Restaurant::query();

        if ($request->filled('area')) {
            $query->where('area_id', $request->area);
        }

        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }

        if ($request->filled('keyword')) {
            $query->where('restaurant_name', 'like', '%' . $request->keyword . '%');
        }

        $restaurants = $query->with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('toppage_after_login', compact('restaurants', 'areas', 'genres'));
    }

    public function toggle(Request $request)
    {
        $user = Auth::user();
        $restaurantId = $request->input('restaurant_id');
        $like = Like::where('user_id', $user->id)
                    ->where('restaurant_id', $restaurantId)
                    ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'restaurant_id' => $restaurantId,
            ]);
        }

        return redirect()->back();
    }

    public function saveImage($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $photoUrl = $restaurant->photo_url;

        if ($photoUrl) {
            $response = Http::get($photoUrl);

            $imagePath = 'restaurants/' . basename($photoUrl);

            Storage::disk('public')->put($imagePath, $response->body());

            $restaurant->photo_url = Storage::url($imagePath);
            $restaurant->save();
        }

        return redirect()->back()->with('status', '画像が保存されました。');
    }
}

