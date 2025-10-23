<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($request->all());
        return [
            'id' => $this->id,
            'title_en' => $this->title_en,
            'title_mm' => $this->title_mm,
            'desc_en' => $this->desc_en,
            'desc_mm' => $this->desc_mm,
            'image_url' => $this->image_url
        ];
    }
}
