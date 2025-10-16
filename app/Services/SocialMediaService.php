<?php

namespace App\Services;

use App\Models\SocialMedia;

class SocialMediaService
{
    public function getSocialMedia($id)
    {
        $socialMedia = SocialMedia::find($id);
        return $socialMedia;
    }

    public function updateSocialMedia($id, $data)
    {
        $updateData = [
            'facebook_link' => $data['facebook_link'],
            'youtube_link' => $data['youtube_link'],
            'tiktok_link' => $data['tiktok_link'],
        ];
        $socialMedia = SocialMedia::find($id);
        $socialMedia->update($updateData);
        return $socialMedia;
    }
}