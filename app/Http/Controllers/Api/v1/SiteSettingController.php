<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettingRequest;
use App\Http\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use App\Services\SiteSettingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

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
        // Get all site settings from DB
        $settings = SiteSetting::all()->keyBy('key');

        // dd($request->file('footer_bg_image'));
        // dd($request->except('_token'));

        foreach ($request->except('_token') as $key => $value) {

            // Handle file upload
            if ($key === 'footer_bg_image' && $request->hasFile('footer_bg_image')) {
                $file = $request->file('footer_bg_image');

                // Generate unique name
                $filename = time() . '_' . $file->getClientOriginalName();

                // Store the file (e.g., in 'public/uploads/settings')
                $file->storeAs('site_setting', $filename, 'public');


                // Delete old file if exists
                if (!empty($settings[$key]->value) && Storage::exists('site_setting' . $settings[$key]->value)) {
                    Storage::delete('site_setting' . $settings[$key]->value);
                }

                // Update DB value
                $settings[$key]->update(['value' => $filename]);
            } else {
                // Regular text or data update
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
