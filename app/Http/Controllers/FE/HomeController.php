<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\SiteSetting;
use App\Services\AboutService;
use App\Services\ActivityService;
use App\Services\HeroService;
use App\Services\ShortService;
use App\Services\UpcomingService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    protected $heroService;
    protected $aboutService;
    protected $shortService;
    protected $upcomingService;
    protected $activityService;

    public function __construct(
        HeroService $heroService, AboutService $aboutService, ShortService  $shortService, UpcomingService $upcomingService, ActivityService $activityService
    )
    {
        $this->heroService = $heroService;
        $this->aboutService = $aboutService;
        $this->shortService = $shortService;
        $this->upcomingService = $upcomingService;
        $this->activityService = $activityService;
    }


    public function index()
    {
        $hero = $this->heroService->getAllHeroContent();
        $about = $this->aboutService->getAboutContent();
        $aboutResource = (new AboutResource($about))->resolve();
        $aboutResource['image_url'] = $aboutResource['image_url']->resolve();
        $short = $this->shortService->getShortContent();
        $upcoming = $this->upcomingService->getUpcomingContent();
        $activity = $this->activityService->getAllActivities();
        $activityBgImage = SiteSetting::where('key', 'activities_bg_image')->value('value');

        return Inertia::render('Home', [
            'translations' => trans('messages'),
            'heroContent' => $hero,
            'aboutContent' => $aboutResource,
            'shortContent' => $short,
            'upcomingContent' => $upcoming,
            'activityContent' => $activity,
            'activityBgImage' => $activityBgImage,
            'locale' => app()->getLocale()
        ]);
    }
}
