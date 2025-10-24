<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'desc_en' => $this->desc_en,
            'desc_mm' => $this->desc_mm,
            'mail' => $this->mail,
            'phone' => $this->phone,
            'address' => $this->address,
            'image_url' => $this->image_url ? asset('storage/' . $this->image_url) : null,
        ];
    }
}
