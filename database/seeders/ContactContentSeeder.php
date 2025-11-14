<?php

namespace Database\Seeders;

use App\Models\ContactContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact_content = [
            'desc_en' => 'Our friendly team would love to hear from you.',
            'desc_mm' => 'ကျွန်တော်တို့ရဲ့အဖွဲ့ဟာခင်ဗျားဆီက သတင်းကောင်းတွေကို စောင့်ကြိုနေပါတယ်။',
            'mail' => 'ngarpyanlarpyihyae@gmail.com',
            'phone' => '+959 432225112',
            'address' =>'23/5 Thirimingalar Ave, Yankin Township, Myanmar.',
            'image_url' => url('images/contact_section/Contact Us.png'),
        ];

        $contact = ContactContent::first();

        if($contact) {
            $contact->update($contact_content);
            return;
        }
        ContactContent::firstOrCreate($contact_content);
    }
}
