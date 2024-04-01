<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedAdvertentie extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertentie_id',
        'related_advertentie_id',
    ];
}
