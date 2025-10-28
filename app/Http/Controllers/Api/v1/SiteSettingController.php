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
        $filteredSettings = $siteSettings->where('key', '!=', 'language_switch');
        $siteSettingResource = SiteSettingResource::collection($filteredSettings);
        return $this->successResponse($siteSettingResource, 'Site Setting fetched successfully');
    }

    public function update(SiteSettingRequest $request)
    {
        $settings = $this->siteSettingService->updateSiteSetting($request);
        $filteredSettings = $settings->where('key', '!=', 'language_switch');
        $siteSettingResource = SiteSettingResource::collection($filteredSettings);
        return $this->successResponse($siteSettingResource, 'Site Settings updated successfully');
    }

}
