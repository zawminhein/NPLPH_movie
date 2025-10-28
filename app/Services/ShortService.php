<?php

namespace App\Services;

use App\Models\ShortContent;
use Illuminate\Support\Facades\Storage;

class ShortService
{
    public function getShortContent($id)
    {
        $short = ShortContent::find($id);
        return $short;
    }

    public function updateShortContent($short, $request)
    {
        $data = $request->all();
        $updateData = [
            'title_en' => $data['title_en'],
            'title_mm' => $data['title_mm'],
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            'youtube_url' => $data['youtube_url'] ?? null,
            'image_url' => $data['image_url'] ?? null,
        ];

        if($request->hasFile('image_url')) {
            if($short->image_url && Storage::disk('public')->exists($short->image_url)) {
                Storage::disk('public')->delete($short->image_url);
            }
            $image = $request->file('image_url');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('shortContent/bg_image', $fileName, 'public');
            $updateData['image_url'] = 'shortContent/bg_image/' . $fileName;
        } else {
            unset($updateData['image_url']);
        }
        $short->update($updateData);
        return $short;
    }
}