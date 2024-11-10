<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';
    protected $fillable = ['area_name'];

    protected $guarded = [
        'id',
    ];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
