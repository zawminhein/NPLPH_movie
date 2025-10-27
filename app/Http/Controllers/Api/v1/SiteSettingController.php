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

                // Store new file
                $file->storeAs($fileKeys[$key], $filename, 'public');

                // Delete old file if it exists
                $oldFile = $settings[$key]->value ?? null;
                if (!empty($oldFile)) {
                    Storage::disk('public')->delete($fileKeys[$key] . $oldFile);
                }

                // Update database with new filename
                $settings[$key]->update(['value' => $filename]);

                continue; // move to next iteration (skip text update)
            }

            // Handle non-file settings (text, boolean, etc.)
            if (isset($settings[$key])) {
                $settings[$key]->update(['value' => $value]);
            }
        }

        // Filter out language switch
        $filteredSettings = $settings->where('key', '!=', 'language_switch');
        $siteSettingResource = SiteSettingResource::collection($filteredSettings);

        return $this->successResponse($siteSettingResource, 'Site Settings updated successfully');
    }

}
