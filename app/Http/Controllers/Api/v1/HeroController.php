<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeroContentRequest;
use App\Http\Resources\HeroResource;
use App\Services\HeroService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HeroController extends Controller
{
    use ApiResponseTrait;
    private $heroService;
    public function __construct(HeroService $heroService)
    {
        $this->heroService = $heroService;
    }
    public function show($id)
    {
        $hero = $this->heroService->getHeroContent($id);
        $heroResource = new HeroResource($hero);
        return $this->successResponse($heroResource, 'Hero fetched successfully');
    }

    
    public function update($id, HeroContentRequest $request)
    {
        $hero = $this->heroService->getHeroContent($id);
        $hero = $this->heroService->updateHeroContent($hero, $request);
        return $this->successResponse(new HeroResource($hero), 'Hero updated successfully');
    }
}
