<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about_content = [
            'desc_en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. Nibh scelerisque ac adipiscing velit non nulla in amet pellentesque. Sit turpis pretium eget maecenas. Vestibulum dolor mattis consectetur eget commodo vitae.
                        Amet pellentesque sit pulvinar lorem mi a, euismod risus rhoncus. Elementum ullamcorper nec, habitasse vulputate. Eget dictum quis est sed egestas tellus, a lectus. Quam ullamcorper in fringilla arcu aliquet fames arcu.Lacinia eget faucibus urna, nam risus nec elementum cras porta. Sed elementum, sed dolor purus dolor dui. Ut dictum nulla pulvinar vulputate sit sagittis in eleifend dignissim. Natoque mauris cras molestie velit. Maecenas eget adipiscing quisque viverra lectus arcu, tincidunt ultrices pellentesque.',
            'desc_mm' => 'ရုပ်ရှင်သည် လူ့ဘဝအတွေ့အကြုံ၊ စိတ်ကူးစိတ်သန်းနှင့် စိတ်ခံစားမှုများကို ရွှေ့ပြောင်းပြောြနိုင်သည့် စွမ်းရှိသော အနုပညာတစ်ခုဖြစ်သည်။ ဇာတ်လမ်းတစ်ပုဒ်၊ ဇာတ်ကောင်တစ်ခုစီတိုင်းသည် ကျွန်ုပ်တို့အား နက်ရှိုင်းသောအဓိပ္ပာယ်များ ရှာဖွေစေကာ လောကကြီးကို မတူညီသောမျက်လုံးများဖြင့် ကြည့်ရှုနားလည်ခွင့်ပေးသည်။',
        ];

        AboutContent::firstOrCreate($about_content);
    }
}
