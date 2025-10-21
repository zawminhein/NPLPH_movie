<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Services\AboutService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutContentController extends Controller
{
    protected $aboutService;

    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }
    public function index()
    {
        $about = $this->aboutService->getAllAboutContent();
        return Inertia::render('Home', [
            'about_translations' => trans('messages'),
            // dd(trans('messages')),
            'aboutContent' => $about,
            'locale' => app()->getLocale()
        ]);
    }
}
