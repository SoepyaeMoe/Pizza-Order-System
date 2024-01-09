<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $image = '';
        if ($this->image == null) {
            $image = "https://ui-avatars.com/api/?name=" . $this->name . "&color=random&background=random";
        } else {
            $image = $this->image;
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $image,
            'created_at' => $this->created_at->format('d-M-Y H:i'),
            'updated_at' => $this->updated_at->format('d-M-Y H:i'),
        ];
    }
}
