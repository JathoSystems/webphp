<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'advertentie_id', 
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function advertentie() {
        return $this->belongsTo(Advertentie::class, 'advertentie_id');
    }
}
