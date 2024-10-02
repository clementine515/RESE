<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Restaurant;
use Carbon\Carbon;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'restaurant_id' => Restaurant::factory(),
            'reservation_date' => $this->faker->dateTimeBetween('now', '2024-08-30')->format('Y-m-d'),
            'guest_count' => $this->faker->numberBetween(1, 10),
        ];
    }
}
