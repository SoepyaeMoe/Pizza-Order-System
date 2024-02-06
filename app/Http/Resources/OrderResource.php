<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status;
        if ($this->status == 0) {
            $status = 'Pending';
        } elseif ($this->status == 1) {
            $status = 'Completed';
        } else {
            $status = 'Rejected';
        }
        return [
            'id' => $this->id,
            'date' => $this->created_at->format('d-M-Y H:i:s'),
            'total_price' => $this->total_price,
            'order_code' => $this->order_code,
            'status' => $status,
        ];
    }
}
