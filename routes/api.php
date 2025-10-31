<?php

use App\Http\Controllers\Api\v1\AboutController;
use App\Http\Controllers\Api\v1\ActivityController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ContactController;
use App\Http\Controllers\Api\v1\HeroController;
use App\Http\Controllers\Api\v1\PermissionController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\ShortController;
use App\Http\Controllers\Api\v1\SiteSettingController;
use App\Http\Controllers\Api\v1\SocialMediaController;
use App\Http\Controllers\Api\v1\UpcomingController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Foundation\Console\UpCommand;

// Define API rate limiter used by 'throttle:api'
RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});

// Route::get('/', function () {
//     return response()->json([
//         'message' => 'API is running',
//     ]);
// });
Route::prefix('v1')->group(function () {
    // Public route
    Route::post('/login', [AuthController::class, 'login']);

    // Protected routes (require Bearer token)
    Route::middleware('auth:sanctum', 'throttle:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        // User routes
        Route::get('/users', [UserController::class, 'index'])->middleware('permission:user_view');
        Route::post('/users', [UserController::class, 'store'])->middleware('permission:user_create');
        Route::get('/users/{id}', [UserController::class, 'show'])->middleware('permission:user_view');
        Route::put('/users/{id}', [UserController::class, 'update'])->middleware('permission:user_update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('permission:user_delete');

        // Role routes
        Route::get('/roles', [RoleController::class, 'index'])->middleware(['permission:role_view']);
        Route::post('/roles', [RoleController::class, 'store'])->middleware('permission:role_create');
        Route::get('/roles/{id}', [RoleController::class, 'show'])->middleware('permission:role_view');
        Route::put('/roles/{id}', [RoleController::class, 'update'])->middleware('permission:role_update');
        Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->middleware('permission:role_delete');

        // HeroContent routes
        Route::get('/heros', [HeroController::class, 'show'])->middleware('permission:hero_view');
        Route::put('/heros', [HeroController::class, 'update'])->middleware('permission:hero_update');

        // AboutContent routes
        Route::get('/abouts', [AboutController::class, 'show'])->middleware('permission:about_view');
        Route::put('/abouts', [AboutController::class, 'update'])->middleware('permission:about_update');
        Route::post('/abouts/content-upload', [AboutController::class, 'contentUpload'])->middleware('permission:about_update');

        //ShortContent routes
        Route::get('/shorts/{id}', [ShortController::class, 'show'])->middleware('permission:short_view');
        Route::put('/shorts/{id}', [ShortController::class, 'update'])->middleware('permission:short_update');

        //UpcomingContent routes
        Route::get('/upcomings/{id}', [UpcomingController::class, 'show'])->middleware('permission:upcoming_view');
        Route::put('/upcomings/{id}', [UpcomingController::class, 'update'])->middleware('permission:upcoming_update');

        //ContactContent routes
        Route::get('/contacts/{id}', [ContactController::class, 'show'])->middleware('permission:contact_view');
        Route::put('/contacts/{id}', [ContactController::class, 'update'])->middleware('permission:contact_update');

        //SiteSettingContent routes
        Route::get('/sitesettings', [SiteSettingController::class, 'show'])->middleware('permission:site_setting_view');
        Route::put('/sitesettings', [SiteSettingController::class, 'update'])->middleware('permission:site_setting_update');

        //SocialMediaContent routes
        Route::get('/socialmedias/{id}', [SocialMediaController::class, 'show'])->middleware('permission:social_media_view');
        Route::put('/socialmedias/{id}', [SocialMediaController::class, 'update'])->middleware('permission:social_media_update');
        
        //ActivityContent routes
        Route::get('/activities', [ActivityController::class, 'index'])->middleware('permission:activity_view');
        Route::get('/activities/{id}', [ActivityController::class, 'show'])->middleware('permission:activity_view');
        Route::post('/activities', [ActivityController::class, 'store'])->middleware('permission:activity_create');
        Route::put('/activities/{id}', [ActivityController::class, 'update'])->middleware('permission:activity_update');
        Route::delete('/activities/{id}', [ActivityController::class, 'destroy'])->middleware('permission:activity_delete');

        Route::get('/permissions-for-role-create', [PermissionController::class, 'index'])->middleware('permission:role_create');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('test',function(){
        return 'test';
    });
});