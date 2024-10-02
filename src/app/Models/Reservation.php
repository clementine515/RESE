<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'reservation_date',
        'reservation_time',
        'guest_count',
        'menu',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getReservationDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getReservationTimeAttribute($value)
    {
        return Carbon::parse($this->attributes['reservation_date'] . ' ' . $this->attributes['reservation_time'])->format('H:i');
    }
}
