<?php 

namespace App\Services;

use App\Models\SiteSetting;

class SiteSettingService
{
    public function getSiteSetting()
    {
        $siteSetting = SiteSetting::all();
        return $siteSetting;
    }

    public function updateSiteSetting($data)
    {
        foreach ($data as $item) {
            SiteSetting::where('key', $item['key'])->update([
                'value' => $item['value'],
            ]);
        }
        $siteSetting = SiteSetting::all();
        return $siteSetting;
    }
}