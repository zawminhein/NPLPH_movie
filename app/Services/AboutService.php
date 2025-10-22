<?php

namespace App\Services;

use App\Models\AboutContent;

class AboutService
{
    public function getAllAboutContent()
    {
        $about = AboutContent::first();
        return $about;
    }
    public function getAboutContent($id)
    {
        $about = AboutContent::find($id);
        return $about;
    }

    public function updateAboutContent($id, $data)
    {
        $updateData = [
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            'image_url' => $data['image_url'],
        ];
        $about = AboutContent::find($id);
        $about->update($updateData);
        return $about;
    }
}