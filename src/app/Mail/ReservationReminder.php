<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ReservationReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('予約リマインダー')
                    ->view('emails.reservation_reminder')
                    ->with([
                        'reservation' => $this->reservation,
                        'restaurant_name' => $this->reservation->restaurant->restaurant_name
                    ]);
    }
}
