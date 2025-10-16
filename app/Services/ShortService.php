<?php

namespace App\Services;

use App\Models\ShortContent;

class ShortService
{
    public function getShortContent($id)
    {
        $short = ShortContent::find($id);
        return $short;
    }

    public function updateShortContent($id, $data)
    {
        $updateData = [
            'title_en' => $data['title_en'],
            'title_mm' => $data['title_mm'],
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            'youtube_url' => $data['youtube_url']
        ];
        $short = ShortContent::find($id);
        $short->update($updateData);
        return $short;
    }
}