<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeroContentRequest;
use App\Http\Resources\HeroResource;
use App\Services\HeroService;
use App\Services\SocialMediaService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HeroController extends Controller
{
    use ApiResponseTrait;
    private $heroService;
    private $socialMediaService;
    public function __construct(HeroService $heroService, SocialMediaService $socialMediaService)
    {
        $this->heroService = $heroService;
        $this->socialMediaService = $socialMediaService;
    }
    public function show($id)
    {
        $hero = $this->heroService->getHeroContent($id);
        $socialMedia = $this->socialMediaService->getSocialMedia($id);
        // dd($socialMedia);
        $heroResource = new HeroResource($hero, $socialMedia);
        return $this->successResponse($heroResource, 'Hero fetched successfully');
    }

    
    public function update($id, HeroContentRequest $request)
    {
        $hero = $this->heroService->getHeroContent($id);
        $socialMedia = $this->socialMediaService->getSocialMedia($id);
        $hero = $this->heroService->updateHeroContent($hero, $socialMedia, $request);
        // dd($hero);
        return $this->successResponse(new HeroResource($hero), 'Hero updated successfully');
    }
}
