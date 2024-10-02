<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurants';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'area_id',
        'genre_id',
        'restaurant_name',
        'description',
        'photo_url',
        'manager_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
