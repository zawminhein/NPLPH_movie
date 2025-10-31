<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Traits\ApiResponseTrait;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    use ApiResponseTrait;

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $roles = $this->roleService->getAllRoles($request);
        $rolesResource = RoleResource::collection($roles);
        return $this->paginationResponse($rolesResource, 'Roles fetched successfully');
    }


    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $role = $this->roleService->storeRole($data);
        $roleResource = new RoleResource($role);
        return $this->successResponse($roleResource, 'Role created successfully', 201);
    }

    public function show($id)
    {
        $role = $this->roleService->getRole($id);
        $roleResource = new RoleResource($role);
        return $this->successResponse($roleResource, 'Role details fetched successfully');
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = $this->roleService->getRole($id);

        // $data = $request->validated();

        $role = $this->roleService->updateRole($role, $request);
        $roleResource = new RoleResource($role);
        return $this->successResponse($roleResource, 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = $this->roleService->getRole($id);
        $this->roleService->deleteRole($role);
        return $this->successResponse('message', 'Role deleted successfully');
    }
}
