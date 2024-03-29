<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdBidding extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'price',
        'user',
        'dateTime',
        'adId',
    ];
}
