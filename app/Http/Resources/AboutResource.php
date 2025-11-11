<?php

namespace App\Http\Resources;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $content = Content::where('type_id', $this->id)
            ->where('type', 'App\\Models\\AboutContent')
            ->get();
        // dd($content);

        return [
            'id' => $this->id,
            'desc_en' => $this->desc_en,
            'desc_mm' => $this->desc_mm,
            'bg_image_url' => $this->image_url,
            'image_url' => ContentResource::collection($content)
        ];
    }
}
