<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'text',
        'image_url',
        'image_alt',
        'order',
    ];

    public function bedrijf()
    {
        return $this->belongsTo(Bedrijf::class);
    }

}
