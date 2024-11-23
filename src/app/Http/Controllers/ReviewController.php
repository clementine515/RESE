<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewReview;
use App\Models\Restaurant;
use App\Http\Requests\CreateReviewRequest;


class ReviewController extends Controller
{
    public function store(CreateReviewRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('reviews', 'public');
        }


        NewReview::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->input('restaurant_id'),
            'star' => !is_null($request->input('star')) ? $request->input('star') : 5,
            'comment' => $request->input('comment'),
            'photo' => $imagePath,
        ]);

        return redirect()->route('mypage');
    }

    public function edit($id)
    {
        $review = NewReview::findOrFail($id);
        $restaurant = $review->restaurant;
        return view('review_form', compact('review', 'restaurant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'nullable|max:400',
            'photo' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        $review = NewReview::findOrFail($id);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('reviews', 'public');
            $review->photo = $imagePath;
        }

        $review->update([
            'star' => $request->input('star', $review->star),
            'comment' => $request->input('comment', $review->comment),
        ]);

        return redirect()->route('shop_detail', ['shop_id' => $review->restaurant_id])
                        ->with('success', '口コミが更新されました');
    }

    public function destroy($id)
    {
        $review = NewReview::findOrFail($id);
        $review->delete();

        return redirect()->route('shop_detail', ['shop_id' => $review->restaurant_id])
                        ->with('success', '口コミが削除されました');
    }

    public function showAllReviews($restaurant_id)
    {
        $reviews = NewReview::where('restaurant_id', $restaurant_id)->get();
        $restaurant = Restaurant::findOrFail($restaurant_id);

        return view('all_reviews', compact('reviews', 'restaurant'));
    }

}
