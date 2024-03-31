<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BiddingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'advertentie_id' => $this->advertentie_id,
            'user_id' => $this->user_id,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
