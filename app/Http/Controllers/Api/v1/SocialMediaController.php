<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
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

    public function show()
    {
        $socialMedia = $this->socialMediaService->getSocialMedia();
        $socialMediaResource = new SocialMediaResource($socialMedia);
        return $this->successResponse($socialMediaResource, 'Social media fetched successfully');
    }

    public function update( SocialMediaRequest $request)
    {
        try{
            $socialMedia = $this->socialMediaService->updateSocialMedia($request->all());
            $socialMediaResource = new SocialMediaResource($socialMedia);
            return $this->successResponse($socialMediaResource, 'Social media updated successfully');
        } catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}
