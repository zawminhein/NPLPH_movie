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

    public function updateHeroContent($hero, $socialMedia, $request)
    {
        $data = $request->all();
        $updateData = [
            'short_desc_en' => $data['short_desc_en'],
            'short_desc_mm' => $data['short_desc_mm'],
            'long_desc_en' => $data['long_desc_en'],
            'long_desc_mm' => $data['long_desc_mm'],
        ];

        $updateSocialMedia = [
            'facebook_link' => $data['facebook_link'],
            'youtube_link' => $data['youtube_link'],
            'tiktok_link' => $data['tiktok_link'],
        ];
        
        // dd($socialMedia);
        $socialMedia->update($updateSocialMedia);

        // If a new image is uploaded
        if ($request->hasFile('image_url')) {
            // Delete the old image if it exists
            if ($hero->image_url && Storage::disk('public')->exists($hero->getRawOriginal('image_url'))) {
                Storage::disk('public')->delete($hero->getRawOriginal('image_url')); // old image_url);
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

        // Merge social media fields into hero for immediate response
        $hero->facebook_link = $socialMedia->facebook_link;
        // dd($socialMedia->facebook_link);
        $hero->youtube_link = $socialMedia->youtube_link;
        $hero->tiktok_link = $socialMedia->tiktok_link;
        // dd($hero);
        return $hero;
    }
}