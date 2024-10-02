<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'star' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'reservation_id' => $request->input('reservation_id'),
            'restaurant_id' => $request->input('restaurant_id'),
            'star' => $request->input('star'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('visit-history');
    }
}
