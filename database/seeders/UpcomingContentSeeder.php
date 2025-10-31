<?php

namespace Database\Seeders;

use App\Models\UpcomingContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpcomingContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $upcoming_content = [
            'title_en' => 'UPCOMING SEASON',
            'title_mm' => 'လာမည့် ဇာတ်လမ်းတွဲ ရုပ်ရှင်',
            'short_desc_en' => 'What next in our upcoming season ?',
            'short_desc_mm' => 'လာမယ့်ဇာတ်လမ်းတွဲမှာ ဘာတွေဆက်ဖြစ်မလဲ။',
            'long_desc_en' => 'Envoys curious to learn more about the continued
                                development of Soulframe would be wise to watch
                                Soulshorts! Join Community Manager Sarah and Soulframe
                                developers as they discuss the latest Preludes updates and
                                beyond.',
            'long_desc_mm' => 'ရုပ်ရှင် သို့မဟုတ် လှုပ်ရှားမှုရုပ်ပုံဟုလည်းသိကြသော ရုပ်ရှင်သည် ဇာတ်လမ်းများပြောပြရန်၊ စိတ်ကူးများပေးပို့ရန် သို့မဟုတ် ဖျော်ဖြေမှု သို့မဟုတ် အနုပညာဆိုင်ရာဖော်ပြမှုများအတွက် စိတ်ခံစားမှုများကို လှုံ့ဆော်ပေးရန်အတွက် ရွေ့လျားနေသောရုပ်ပုံများနှင့် အသံများကို အသုံးပြုသည့် ရုပ်ပုံများနှင့် အသံဆက်သွယ်မှုပုံစံတစ်ခုဖြစ်သည်။',
            'image_url' => url('images/upcoming_section/upcoming_banner2.png'),
            'bg_image_url' => url('images/upcoming_section/upcoming_banner1.png'),
        ];

        $upcoming = UpcomingContent::first();

        if ($upcoming) {
            $upcoming->update($upcoming_content);
            return;
        }

        UpcomingContent::firstOrCreate($upcoming_content);
    }
}
