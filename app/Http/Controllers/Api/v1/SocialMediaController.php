<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialMediaResource;
use App\Services\SocialMediaService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    use ApiResponseTrait;

    protected $socialMediaService;

    public function __construct(SocialMediaService $socialMediaService)
    {
        $this->socialMediaService = $socialMediaService;
    }

    public function show($id)
    {
        $socialMedia = $this->socialMediaService->getSocialMedia($id);
        $socialMediaResource = new SocialMediaResource($socialMedia);
        return $this->successResponse($socialMediaResource, 'Social media fetched successfully');
    }

    public function update($id, Request $request)
    {
        $socialMedia = $this->socialMediaService->updateSocialMedia($id, $request->all());
        $socialMediaResource = new SocialMediaResource($socialMedia);
        return $this->successResponse($socialMediaResource, 'Social media updated successfully');
    }
}
