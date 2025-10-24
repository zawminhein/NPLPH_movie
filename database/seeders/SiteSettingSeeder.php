<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $site_settings = [
            [
                'key' => 'site_name_en',
                'description' => 'Site Name',
                'value' => 'NGARPYANLARPYIHYAE'
            ],

            [
                'key' => 'site_name_mm',
                'description' => 'Site Name (Myanmar)',
                'value' => '“ငါပြန်လာပြီဟေ့”'
            ],

            [
                'key' => 'address',
                'description' => 'Address',
                'value' => '23/5 Thirimingalar Ave, Yankin Township, Myanmar.'
            ],

            [
                'key' => 'email',
                'description' => 'Email',
                'value' => 'ngarpyanlarpyihyae@gmail.com'
            ],

            [
                'key' => 'footer_desc1',
                'description' => 'Footer Description 1',
                'value' => 'A handcrafted collection of cinematic masterpieces, curated with
                            love and passion for the art of filmmaking.'
            ],

            [
                'key' => 'footer_desc2',
                'description' => 'Footer Description 2',
                'value' => '"Cinema is a matter of what\'s in the frame and what\'s out." - Martin Scorsese'
            ],

            [
                'key' => 'privacy_policy',
                'description' => 'Privacy Policy',
                'value' => 'Privacy Policy'
            ],

            [
                'key' => 'terms_of_service',
                'description' => 'Terms of Use',
                'value' => 'Terms of Use'
            ],

            [
                'key' => 'language_switch',
                'description' => 'Language Switch',
                'value' => 'true'
            ],

            [
                'key' => 'footer_bg_image',
                'description' => 'Footer Background Image',
                'value' => 'footer-bg.jpg'
            ]
        ];

        foreach ($site_settings as $site_setting) {
            SiteSetting::firstOrCreate($site_setting);
        }
    }
}
