<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertentie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_url',
        'title',
        'description',
        'price',
        'expiration_date',
        'status',
        'QR_code',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'expiration_date' => 'datetime',
    ];
}
