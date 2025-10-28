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

        // dd($hero->image_url);
        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($hero->image_url && Storage::disk('public')->exists($hero->image_url)) {
                Storage::disk('public')->delete($hero->image_url);
            }

            $image = $request->file('image_url');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('heroContent', $fileName, 'public');
            $updateData['image_url'] = 'heroContent/' . $fileName;
        } 
        elseif ($request->filled('image_url') === false && $hero->image_url) 
        {
            Storage::disk('public')->delete($hero->image_url);
            $updateData['image_url'] = null;
        } else {
            unset($updateData['image_url']);
        }
        $hero -> update($updateData);
        return $hero;
    }
}