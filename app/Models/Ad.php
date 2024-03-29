<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'titel',
        'description',
        'image',
        'price',
        'type',
    ];


    public function scopeBiedingen($query){
        return $query->where('type', 'bieding');
    }
}
