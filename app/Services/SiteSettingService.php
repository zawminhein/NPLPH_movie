<?php 

namespace App\Services;

use App\Models\SiteSetting;

class SiteSettingService
{
    public function getSiteSetting($id)
    {
        $siteSetting = SiteSetting::find($id);
        return $siteSetting;
    }

    public function updateSiteSetting($id, $data)
    {
        $updateData = [
            'value' => $data['value']
        ];
        $siteSetting = SiteSetting::find($id);
        $siteSetting->update($updateData);
        return $siteSetting;
    }
}