<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
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

    public function show($id)
    {
        $siteSetting = $this->siteSettingService->getSiteSetting($id);
        $siteSettingResource = new SiteSettingResource($siteSetting);
        return $this->successResponse($siteSettingResource, 'Site Setting fetched successfully');
    }

    public function update($id, Request $request)
    {
        $siteSetting = $this->siteSettingService->updateSiteSetting($id, $request->all());
        $siteSettingResource = new SiteSettingResource($siteSetting);
        return $this->successResponse($siteSettingResource, 'Site Setting updated successfully');
    }
}
