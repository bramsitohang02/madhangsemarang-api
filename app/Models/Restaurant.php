<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'location', 'category', 'description', 'image_url', 
    'user_id', 'status',
    // Tambahkan ini
    'operating_hours', 'price_range', 'contact_number', 'website_url'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function photos()
    {
    return $this->hasMany(RestaurantPhoto::class);
    }
}