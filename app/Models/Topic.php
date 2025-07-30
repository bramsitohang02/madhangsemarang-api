<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'user_id'];

    /**
     * Mendapatkan semua komentar untuk topik ini.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Mendapatkan pengguna yang memiliki topik ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}