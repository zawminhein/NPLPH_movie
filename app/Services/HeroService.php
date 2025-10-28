<?php

namespace App\Services;

use App\Models\HeroContent;
use Illuminate\Support\Facades\Storage;

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

    public function updateHeroContent($hero, $request)
    {
        $data = $request->all();
        $updateData = [
            'short_desc_en' => $data['short_desc_en'],
            'short_desc_mm' => $data['short_desc_mm'],
            'long_desc_en' => $data['long_desc_en'],
            'long_desc_mm' => $data['long_desc_mm'],
        ];

        // If a new image is uploaded
        if ($request->hasFile('image_url')) {
            // Delete the old image if it exists
            if ($hero->image_url && Storage::disk('public')->exists($hero->image_url)) {
                Storage::disk('public')->delete($hero->image_url);
            }

            // Store new image
            $image = $request->file('image_url');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('heroContent', $fileName, 'public');
            $updateData['image_url'] = 'heroContent/' . $fileName;
        } else {
            // No new image — keep existing one
            unset($updateData['image_url']);
        }
        $hero -> update($updateData);
        return $hero;
    }
}