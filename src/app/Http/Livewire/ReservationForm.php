<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Requests\CreateReservationRequest;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ReservationForm extends Component
{
    public $restaurant;
    public $reservation_date;
    public $reservation_time;
    public $guest_count;
    public $errors = [];
    public $menu;

    public function mount($restaurant)
    {
        $this->restaurant = $restaurant;
        $this->reservation_date = '';
        $this->reservation_time = '';
        $this->guest_count = '';
        $this->menu = '';
    }

    public function updated($propertyName)
    {
        $this->validateInput();
    }

    public function validateInput()
    {
        $this->validate(CreateReservationRequest::rules(), CreateReservationRequest::messages());
        $this->errors = [];
    }

    public function submit()
    {
        $validatedData = $this->validate(CreateReservationRequest::rules());

        if ($this->menu) {
            return redirect()->route('stripe.payment', [
                'reservation_date' => $this->reservation_date,
                'reservation_time' => $this->reservation_time,
                'guest_count' => $this->guest_count,
                'restaurant_id' => $this->restaurant->id,
                'menu' => $this->menu,
            ]);
        } else {
            return redirect()->route('reservations.store', [
                'reservation_date' => $this->reservation_date,
                'reservation_time' => $this->reservation_time,
                'guest_count' => $this->guest_count,
                'restaurant_id' => $this->restaurant->id,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.reservation-form', [
            'restaurant' => $this->restaurant,
        ]);
    }

}