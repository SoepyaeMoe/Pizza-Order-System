<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => $this->category->name,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price . ' MMK',
            'view' => $this->view_count,
            'created_at' => $this->created_at->format('d-M-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-M-Y H:i:s'),
        ];
    }
}
