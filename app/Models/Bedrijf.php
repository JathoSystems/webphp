<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bedrijf extends Model
{
    use HasFactory;

    protected $table = 'bedrijven';

    protected $fillable = [
        'name',
        'user_id',
        'logo_url',
        'color_scheme',
        'landing_page_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    protected $casts = [
        'color_scheme' => 'array',
    ];
}
