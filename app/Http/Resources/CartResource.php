<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'user_id' => $this->user_id,
            'product' => $this->product->name,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            // 'sub_total' => $this->price * $this->quantity . ' Kyats',
            // 'grand_total' => $this->price * $this->quantity + 3000 . ' Kyats',
            'created_at' => $this->created_at->format('d-M-Y H:i:s'),
        ];
    }
}
