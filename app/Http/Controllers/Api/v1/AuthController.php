<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\SiteSettingLoginResource;
use App\Http\Resources\UserResource;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\LoginService;
use App\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;

    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Login and get Bearer token
     */
    public function login(LoginRequest $request)
    {
        // $request->validated();
        // dd($request->all());

        $user = $this->loginService->login($request);
        // dd($user);
        if (!$user) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        // Create new token for this device
        $token = $user->createToken('mobile_token')->plainTextToken;
        $userResource = new UserResource($user);
        return $this->successResponse([
            'token_type' => 'Bearer',
            'access_token' => $token,
            'user' => $userResource,
            'permissions' => $user->getPermissionsViaRoles()->pluck('name'),
            'sitesettings' => SiteSetting::pluck('value', 'key'),
        ], 'Login Successful');
    }

    /**
     * Logout and revoke the token
     */
    public function logout(Request $request)
    {
        $request->user()?->currentAccessToken()?->delete();
        return $this->successResponse(['message' => 'Logged out successfully']);
    }
}
