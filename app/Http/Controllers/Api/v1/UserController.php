<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
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
        $usersResource = UserResource::collection($users);
        return $this->paginationResponse($usersResource, $users, 'Users fetched successfully');
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        $userResource = new UserResource($user);
        return $this->successResponse($userResource, 'User created successfully', 201);
    }

    public function show($id)
    {
        $user = $this->userService->getUser($id);
        $userResource = new UserResource($user);
        return $this->successResponse($userResource, 'User details fetched successfully');
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user = $this->userService->updateUser($user, $request->all());
        $userResource = new UserResource($user);
        return $this->successResponse($userResource, 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->userService->deleteUser($user);
        return $this->successResponse('message', 'User deleted successfully');
    }
}
