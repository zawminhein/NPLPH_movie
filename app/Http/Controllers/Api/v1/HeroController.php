<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Services\HeroService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

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

    public function update($id, Request $request)
    {
        $hero = $this->heroService->updateHeroContent($id, $request->all());
        $heroResource = new HeroResource($hero);
        return $this->successResponse($heroResource, 'Hero updated successfully');
    }
}
