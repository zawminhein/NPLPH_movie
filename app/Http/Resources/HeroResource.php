<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroResource extends JsonResource
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
            'short_desc_en' => $this->short_desc_en,
            'short_desc_mm' => $this->short_desc_mm,
            'long_desc_en' => $this->long_desc_en,
            'long_desc_mm' => $this->long_desc_mm,
            'image_url' => $this->image_url ? asset('storage/' . $this->image_url) : null,
        ];
    }
}
