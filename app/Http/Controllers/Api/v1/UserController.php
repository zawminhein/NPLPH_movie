<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    use ApiResponseTrait;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers($request);
        $usersResource = UserResource::collection($users);
        return $this->paginationResponse($usersResource, $users, 'Users fetched successfully');
    }

    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = $this->userService->storeUser($request->validated());
            $userResource = new UserResource($user);
            DB::commit();
            return $this->successResponse($userResource, 'User created successfully', 201);
        }catch(\Exception $e){
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        $user = $this->userService->getUser($id);
        $userResource = new UserResource($user);
        return $this->successResponse($userResource, 'User details fetched successfully');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $user = User::findOrFail($id);
            $user = $this->userService->updateUser($user, $request->all());
            $userResource = new UserResource($user);
            DB::commit();
            return $this->successResponse($userResource, 'User updated successfully');
        }catch(\Exception $e){
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $this->userService->deleteUser($user);
            return $this->successResponse('message', 'User deleted successfully');
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}
