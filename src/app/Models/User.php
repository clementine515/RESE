<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favoriteRestaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'likes');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function hasLiked($restaurantId)
    {
        return $this->likes()->where('restaurant_id', $restaurantId)->exists();
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isManager()
    {
        return $this->role === 'manager';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }


}
