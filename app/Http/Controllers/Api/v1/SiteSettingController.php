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

    public function update(SiteSettingRequest $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string|exists:site_settings,key',
            'settings.*.value' => 'nullable|string',
        ]);
        dd($validated);

        $siteSetting = $this->siteSettingService->updateSiteSetting($request->validated());
        $siteSettingResource = new SiteSettingResource($siteSetting);
        return $this->successResponse($siteSettingResource, 'Site Setting updated successfully');
    }
}
