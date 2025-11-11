<?php

namespace App\Services;

use App\Models\UpcomingContent;
use Illuminate\Support\Facades\Storage;

class UpcomingService
{
    public function getUpcomingContent()
    {
        $upcoming = UpcomingContent::first();
        return $upcoming;
    }
    
    public function updateUpcomingContent($upcoming, $request)
    {
        $data = $request->all();

        $updateData = [
            'title_en' => $data['title_en'],
            'title_mm' => $data['title_mm'],
            'short_desc_en' => $data['short_desc_en'],
            'short_desc_mm' => $data['short_desc_mm'],
            'long_desc_en' => $data['long_desc_en'],
            'long_desc_mm' => $data['long_desc_mm'],
        ];

        // Handle image uploads with helper method
        $updateData['image_url'] = $this->handleImageUpload($request, $upcoming, 'image_url', 'upcomingContent/content_image');
        $updateData['bg_image_url'] = $this->handleImageUpload($request, $upcoming, 'bg_image_url', 'upcomingContent/bg_image');

        $upcoming->update($updateData);

        return $upcoming;
    }

    protected function handleImageUpload($request, $upcoming, $field, $path)
    {
        if ($request->hasFile($field)) {
            if ($upcoming->$field && Storage::disk('public')->exists($upcoming->getRawOriginal($field))) {
                Storage::disk('public')->delete($upcoming->getRawOriginal($field));
            }

            $file = $request->file($field);
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $filename, 'public');
            return "$path/$filename";
        }
        return $upcoming->$field;
    }
}