<?php

namespace App\Http\Controllers;

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
}
