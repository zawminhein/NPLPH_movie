<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $social_media = [
            'facebook_link' => 'https://www.facebook.com/',
            'youtube_link' => 'https://www.youtube.com/',
            'tiktok_link' => 'https://www.tiktok.com/',
        ];

        $social = SocialMedia::first();

        if($social) {
            $social->update($social_media);
            return;
        }

        SocialMedia::firstOrCreate($social_media);
    }
}
