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
        $hasImage;
        if ($this->image == null) {
            $image = "https://ui-avatars.com/api/?name=" . $this->name . "&color=random&background=random";
            $hasImage = false;
        } else {
            $image = $this->image;
            $hasImage = true;
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $image,
            'hasImage' => $hasImage,
            'created_at' => $this->created_at->format('d-M-Y'),
            'updated_at' => $this->updated_at->format('d-M-Y'),
        ];
    }
}
