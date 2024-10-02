<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'restaurant_id' => Restaurant::factory(),
        ];
    }
}
