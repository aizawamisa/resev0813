<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'summary',
        'prefecture_id',
        'genre_id',
        'image_url',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'shop_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'shop_id');
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
