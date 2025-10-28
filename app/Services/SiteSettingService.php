<?php 

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class SiteSettingService
{
    public function getSiteSetting()
    {
        $siteSetting = SiteSetting::all();
        return $siteSetting;
    }

    public function updateSiteSetting($request)
    {
        $request->validated();
        $siteSettings = SiteSetting::all()->keyBy('key');

        // Define which settings correspond to file uploads and their storage directories
        $fileKeys = [
            'footer_bg_image' => 'site_setting/footer_bg_image/',
            'activities_bg_image' => 'site_setting/activities_bg_image/',
        ];

        foreach ($request->except('_token') as $key => $value) {
            // Handle image uploads
            if (array_key_exists($key, $fileKeys) && $request->hasFile($key)) {
                $file = $request->file($key);
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $fileKeys[$key] . $filename;

                if (
                    isset($siteSettings[$key]) &&
                    !empty($siteSettings[$key]->value) &&
                    Storage::disk('public')->exists($siteSettings[$key]->value)
                ) {
                    Storage::disk('public')->delete($siteSettings[$key]->value);
                }

                $file->storeAs($fileKeys[$key], $filename, 'public');

                $siteSettings[$key]->update(['value' => $path]);

                continue; // Skip to next key
            } else {
                // Handle non-file settings (text, boolean, etc.)
                if (isset($siteSettings[$key])) {
                    $siteSettings[$key]->update(['value' => $value]);
                }
            }
        }
        return $siteSettings;
    }
}