<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // TAMBAHKAN PROPERTI DI BAWAH INI
    protected $fillable = ['body', 'user_id', 'topic_id'];


    /**
     * Mendapatkan pengguna yang memiliki komentar ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}