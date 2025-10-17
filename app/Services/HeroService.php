<?php

namespace App\Services;

use App\Models\HeroContent;

class HeroService
{
    public function getAllHeroContent()
    {
        return HeroContent::first();
    }
    public function getHeroContent($id)
    {
        return HeroContent::find($id);
    }

    public function updateHeroContent($id, $data)
    {
        $updateData = [
            'short_desc_en' => $data['short_desc_en'],
            'short_desc_mm' => $data['short_desc_mm'],
            'long_desc_en' => $data['long_desc_en'],
            'long_desc_mm' => $data['long_desc_mm'],
            'image_url' => $data['image_url'],
        ];

        $hero = HeroContent::find($id);
        $hero -> update($updateData);
        return $hero;
    }
}