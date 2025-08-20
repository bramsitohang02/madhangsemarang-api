<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantPhoto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'image_path',
    ];

    /**
     * Mendapatkan pengguna yang memiliki foto ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan restoran yang memiliki foto ini.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}