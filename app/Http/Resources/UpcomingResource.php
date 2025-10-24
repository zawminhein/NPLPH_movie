<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpcomingResource extends JsonResource
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
            'title_en' => $this->title_en,
            'title_mm' => $this->title_mm,
            'short_desc_en' => $this->short_desc_en,
            'short_desc_mm' => $this->short_desc_mm,
            'long_desc_en' => $this->long_desc_en,
            'long_desc_mm' => $this->long_desc_mm,
            'image_url' => $this->image_url ? asset('storage/' . $this->image_url) : null,
            'bg_image_url' => $this->bg_image_url ? asset('storage/' . $this->bg_image_url) : null,
        ];
    }
}
