<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Services\HeroService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HeroContentController extends Controller
{
    protected $heroService;

    public function __construct(HeroService $heroService)
    {
        $this->heroService = $heroService;
    }
    public function index()
    {
        $hero = $this->heroService->getAllHeroContent();
        return Inertia::render('Home', [
            'translations' => trans('messages'),
            // dd(trans('messages')),
            'heroContent' => $hero,
            'locale' => app()->getLocale()
        ]);
    }
}
