<?php

namespace App\Http\Controllers\FE;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\HeroService;
use App\Services\AboutService;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;

class HomeController extends Controller
{
    protected $heroService;
    protected $aboutService;

    public function __construct(HeroService $heroService, AboutService $aboutService)
    {
        $this->heroService = $heroService;
        $this->aboutService = $aboutService;
    }


    public function index()
    {
        $hero = $this->heroService->getAllHeroContent();
        $about = $this->aboutService->getAboutContent();
        $aboutResource = new AboutResource($about);
        // dd($hero);
        return Inertia::render('Home', [
            'translations' => trans('messages'),
            // dd(trans('messages')),
            'heroContent' => $hero,
            'aboutContent' => $aboutResource,
            'locale' => app()->getLocale()
        ]);
    }
}
