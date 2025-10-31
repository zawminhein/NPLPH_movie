<?php

use Inertia\Inertia;
use App\Models\HeroContent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FE\HomeController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
