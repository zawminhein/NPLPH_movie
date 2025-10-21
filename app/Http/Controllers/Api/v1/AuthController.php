<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * Login and get Bearer token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        // Create new token for this device
        $token = $user->createToken('mobile_token')->plainTextToken;
        $userResource = new UserResource($user);
        return $this->successResponse([
            'token_type' => 'Bearer',
            'access_token' => $token,
            'user' => $userResource,
            'permissions' => $user->getPermissionsViaRoles()->pluck('name'),
            'sitesettings' => SiteSetting::all(),
        ], 'Login successful');
    }

    /**
     * Logout and revoke the token
     */
    public function logout(Request $request)
    {
        $request->user()?->currentAccessToken()?->delete();
        return $this->successResponse(['message' => 'Logged out successfully']);
    }


    /**
     * Get authenticated user details
     */
    public function me(Request $request)
    {
        return $this->successResponse($request->user(), 'Authenticated user data');
    }
}
