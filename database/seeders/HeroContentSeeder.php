<?php

namespace Database\Seeders;

use App\Models\HeroContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $hero_content = [
            'short_desc_en' => '~ A handcrafted collection of cinematic masterpieces ~',
            'short_desc_mm' => 'အထိမ်းအမှတ် ရုပ်ရှင်',
            'long_desc_en' => "Discover timeless films, read passionate reviews, and dive deep into the art of cinema. Every movie tells a story, and we're here to share those stories with you.",
            'long_desc_mm' => 'ရှေးဟောင်းဇာတ်ကားများမှ စိတ်လှုပ်ရှားဖွယ် ဇာတ်လမ်းများကို အတူတူ လေ့လာကြည့်ရှုကြပါစို့။',
            'image_url' => '/public/images/hero_section/hero_section_banner1.png',
        ];

        HeroContent::firstOrCreate($hero_content);
    }
}
