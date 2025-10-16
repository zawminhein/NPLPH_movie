<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortResource extends JsonResource
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
            'desc_en' => $this->desc_en,
            'desc_mm' => $this->desc_mm,
            'youtube_url' => $this->youtube_url
        ];
    }
}
