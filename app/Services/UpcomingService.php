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

    // public function updateUpcomingContent($upcoming, $request)
    // {
    //     $data = $request->all();
    //     $updateData = [
    //         'title_en' => $data['title_en'],
    //         'title_mm' => $data['title_mm'],
    //         'short_desc_en' => $data['short_desc_en'],
    //         'short_desc_mm' => $data['short_desc_mm'],
    //         'long_desc_en' => $data['long_desc_en'],
    //         'long_desc_mm' => $data['long_desc_mm'],
    //         'image_url' => $data['image_url'] ?? null,
    //         'bg_image_url' => $data['bg_image_url'] ?? null,
    //     ];
    //     if($request->hasFile('image_url')) {
    //         if($upcoming->image_url && Storage::disk('public')->exists($upcoming->image_url)) {
    //             Storage::disk('public')->delete($upcoming->image_url);
    //         }
    //         $image = $request->file('image_url');
    //         $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //         $image->storeAs('upcomingContent/content_image', $filename, 'public');
    //         $updateData['image_url'] = 'upcomingContent/content_image/' . $filename;
    //     } elseif ($request->filled('image_url') === false && $upcoming->image_url) {
    //         Storage::disk('public')->delete($upcoming->image_url);
    //         $updateData['image_url'] = null;
    //     } else {
    //         unset($updateData['image_url']);
    //     }

    //     if($request->hasFile('bg_image_url')) {
    //         if($upcoming->bg_image_url && Storage::disk('public')->exists($upcoming->bg_image_url)) {
    //             Storage::disk('public')->delete($upcoming->bg_image_url);
    //         }
    //         $image = $request->file('bg_image_url');
    //         $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //         $image->storeAs('upcomingContent/bg_image', $filename, 'public');
    //         $updateData['bg_image_url'] = 'upcomingContent/bg_image/' . $filename;
    //     } elseif ($request->filled('bg_image_url') === false && $upcoming->bg_image_url) {
    //         Storage::disk('public')->delete($upcoming->bg_image_url);
    //         $updateData['bg_image_url'] = null;
    //     } else {
    //         unset($updateData['bg_image_url']);
    //     }

    //     $upcoming->update($updateData);
    //     return $upcoming;
    // }
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