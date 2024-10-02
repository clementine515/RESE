<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    protected $signature = 'reservations:send-reminders';
    protected $description = '今日の予約に対してリマインダーメールを送信します';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // 今日の日付を取得
        $today = Carbon::now()->toDateString();

        // 今日の予約を取得
        $reservations = Reservation::whereDate('reservation_date', $today)->get();

        foreach ($reservations as $reservation) {
            // 予約者にリマインダーメールを送信
            Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));
        }

        $this->info('リマインダーのメールを送信しました。');
    }
}
