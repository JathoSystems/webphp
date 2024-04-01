<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Advertentie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type', // 'advertentie' or 'verhuur_advertentie
        'image_url',
        'title',
        'description',
        'price',
        'expiration_date',
        'status',
        'QR_code',
        'slijtage',
        'slijtage_percentage',
        'image_upload',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function related_advertenties() {
        return $this->hasMany(RelatedAdvertentie::class, 'advertentie_id', 'id');
    }

    protected $casts = [
        'expiration_date' => 'datetime',
    ];
}
