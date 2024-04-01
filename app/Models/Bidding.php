<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_id',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ad()
    {
        return $this->belongsTo(Advertentie::class);
    }

    public function isHighestBid($ad_id, $currentBidAmount){
        $biddings = Bidding::where('ad_id', $ad_id)->get();

        $highestBid = 0;
        foreach ($biddings as $bid) {
            if ($bid->price > $highestBid) {
                $highestBid = $bid->price;
            }
        }

        if ($currentBidAmount >= $highestBid) {
            return true;
        } else {
            return false;
        }
    }
}
