<?php

namespace App\Services;

use App\Models\UpcomingContent;

class UpcomingService
{
    public function getUpcomingContent($id)
    {
        $upcoming = UpcomingContent::find($id);
        return $upcoming;
    }

    public function updateUpcomingContent($id, $data)
    {
        $updateData = [
            'title_en' => $data['title_en'],
            'title_mm' => $data['title_mm'],
            'short_desc_en' => $data['short_desc_en'],
            'short_desc_mm' => $data['short_desc_mm'],
            'long_desc_en' => $data['long_desc_en'],
            'long_desc_mm' => $data['long_desc_mm'],
            'image_url' => $data['image_url'] ?? null,
            'bg_image_url' => $data['bg_image_url'] ?? null,
        ];
        $upcoming = UpcomingContent::find($id);
        $upcoming->update($updateData);
        return $upcoming;
    }
}