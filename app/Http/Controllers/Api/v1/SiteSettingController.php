<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettingRequest;
use App\Http\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use App\Services\SiteSettingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    use ApiResponseTrait;

    protected $siteSettingService;

    public function __construct(SiteSettingService $siteSettingService)
    {
        $this->siteSettingService = $siteSettingService;
    }

    public function show()
    {
        $siteSettings = $this->siteSettingService->getSiteSetting();
        // dd($siteSetting);
        $filteredSettings = $siteSettings->where('key', '!=', 'language_switch');
        $siteSettingResource = SiteSettingResource::collection($filteredSettings);
        return $this->successResponse($siteSettingResource, 'Site Setting fetched successfully');
    }

    public function update(Request $request)
    {   
        $settings = SiteSetting::all()->keyBy('key');

        foreach ($request->except('_token') as $key => $value) {

            // Handle file upload (footer background image)
            if ($key === 'footer_bg_image' && $request->hasFile('footer_bg_image')) {

                $file = $request->file('footer_bg_image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store new file in 'public/site_setting'
                $file->storeAs('site_setting/footer_bg_image', $filename, 'public');

                // Delete old file if exists
                if (!empty($settings[$key]->value) && Storage::disk('public')->exists('site_setting/footer_bg_image/' . $settings[$key]->value)) {
                    Storage::disk('public')->delete('site_setting/footer_bg_image/' . $settings[$key]->value);
                }

                // Update DB value
                $settings[$key]->update(['value' => $filename]);

            }

            if($key === 'activities_bg_image' && $request->hasFile('activities_bg_image')) {
                $file = $request->file('activities_bg_image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store new file in 'public/site_setting'
                $file->storeAs('site_setting/activities_bg_image', $filename, 'public');

                // dd(Storage::disk('public')->exists('site_setting/activities_bg_image/' . $settings[$key]->value));
                // Delete old file if exists
                if (!empty($settings[$key]->value) && Storage::disk('public')->exists('site_setting/activities_bg_image/' . $settings[$key]->value)) {
                    Storage::disk('public')->delete('site_setting/activities_bg_image/' . $settings[$key]->value);
                }

                // Update DB value
                $settings[$key]->update(['value' => $filename]);
            } else {
                // Regular text/data update
                if (isset($settings[$key])) {
                    $settings[$key]->update(['value' => $value]);
                }
            }
        }

        $filteredSettings = $settings->where('key', '!=', 'language_switch');
        $site_setting_resource = SiteSettingResource::collection($filteredSettings);

        return $this->successResponse($site_setting_resource, 'Site Settings updated successfully');
    }
}
