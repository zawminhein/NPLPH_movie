<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return $this->successResponse($users, 'Users fetched successfully');
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return $this->successResponse($user, 'User created successfully', 201);
    }

    public function show($id)
    {
        $user = $this->userService->getUser($id);
        return $this->successResponse($user, 'User details fetched successfully');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user = $this->userService->updateUser($user, $request->all());
        return $this->successResponse($user, 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->userService->deleteUser($user);
        return $this->successResponse(null, 'User deleted successfully', 204);
    }
}
