<?php

namespace Database\Seeders;

use App\Models\ShortContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShortContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $short_content = [
            'title_en' => 'What awaits in futures untold?',
            'title_mm' => 'ကျန်ရစ်နေသေးသည့် အနာဂတ်က ဘာတွေများ ဖုံးကွယ်ထားသနည်း။',
            'desc_en' => 'Envoys curious to learn more about the continued
                        development of Soulframe would be wise to watch
                        Soulshorts! Join Community Manager Sarah and Soulframe
                        developers as they discuss the latest Preludes updates and
                        beyond.',
            'desc_mm' => '"ငါပြန်လာပြီဟေ့" ၏ ဆက်လက်ဖွံ့ဖြိုးမှုကို သိရှိလိုသော စုံစမ်းလိုစိတ်ပြင်းပြသူများသည်ဂရုတစိုက် ကြည့်ရှုသင့်ပါသည်။ ',
            'youtube_url' => 'https://www.youtube.com/watch?v=9bZkp7q19f0',
            'image_url' => url('images/shorts_section/shorts_section_banner.png'),
        ];

        $short = ShortContent::first();

        if ($short) {
            $short->update($short_content);
            return;
        }

        ShortContent::firstOrCreate($short_content);
    }
}
