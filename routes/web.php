<?php

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

Route::get('/', function(){
    $hero = HeroContent::first();
    return Inertia::render('Home', [
        'heroContent' => $hero,
    ]);
});

Route::get('/home', function(){
    $hero = HeroContent::first();
    return Inertia::render('Home', [
        'heroContent' => $hero,
    ]);
});
