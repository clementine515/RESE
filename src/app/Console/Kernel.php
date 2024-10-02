<?php

namespace App\Console;

use App\Models\Reservation;
use App\Mail\ReservationReminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\SaveRestaurantPhotos::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $reservations = Reservation::whereDate('reservation_date', now()->toDateString())
                                        ->whereTime('reservation_time', '>', now()->format('H:i'))
                                        ->with('user')
                                        ->get();

            foreach ($reservations as $reservation) {
                Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
