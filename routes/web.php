<?php

use App\Http\Controllers\FE\HeroContentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\HeroContent;

// Route::get('/', function () {
//     return Inertia::render('Home');
// });
Route::get('/set-locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return back();
})->name('set-locale');

// Route::get('/', function(){
//     $hero = HeroContent::first();
//     return Inertia::render('Home', [
//         'translations' => trans('messages'),
//         // dd(trans('messages')),
//         'heroContent' => $hero,
//         'locale' => app()->getLocale(),
//     ]);
// });

Route::get('/', [HeroContentController::class, 'index']);
Route::get('/home', [HeroContentController::class, 'index']);
