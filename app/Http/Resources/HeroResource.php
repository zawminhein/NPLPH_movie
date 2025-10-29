<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroResource extends JsonResource
{
    public $socialMedia;

    public function __construct($resource, $socialMedia = null)
    {
        parent::__construct($resource);
        $this->socialMedia = $socialMedia;
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'short_desc_en' => $this->short_desc_en,
            'short_desc_mm' => $this->short_desc_mm,
            'long_desc_en' => $this->long_desc_en,
            'long_desc_mm' => $this->long_desc_mm,
            'image_url' => $this->image_url,
            'facebook_link' => $this->facebook_link ?? $this->socialMedia->facebook_link,
            'youtube_link' => $this->youtube_link ?? $this->socialMedia->youtube_link,
            'tiktok_link' => $this->tiktok_link ?? $this->socialMedia->tiktok_link,
        ];
    }
}

