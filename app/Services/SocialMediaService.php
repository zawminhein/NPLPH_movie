<?php

namespace App\Services;

use App\Models\SocialMedia;

class SocialMediaService
{
    public function getSocialMedia()
    {
        $socialMedia = SocialMedia::first();
        return $socialMedia;
    }

    public function updateSocialMedia( $data)
    {
        $updateData = [
            'facebook_link' => $data['facebook_link'],
            'youtube_link' => $data['youtube_link'],
            'tiktok_link' => $data['tiktok_link'],
        ];
        $socialMedia = SocialMedia::first();
        $socialMedia->update($updateData);
        return $socialMedia;
    }
}