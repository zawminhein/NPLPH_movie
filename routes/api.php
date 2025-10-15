<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\HeroController;

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
        Route::get('/me', [AuthController::class, 'me']);
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
        Route::get('/heros/{id}', [HeroController::class, 'show'])->middleware('permission:hero_view');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('test',function(){
        return 'test';
    });
});