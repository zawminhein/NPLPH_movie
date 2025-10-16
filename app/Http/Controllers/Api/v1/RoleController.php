<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use ApiResponseTrait;

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        $rolesResource = RoleResource::collection($roles);
        return $this->successResponse($rolesResource, 'Roles fetched successfully');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = $this->roleService->createRole($data);
        $roleResource = new RoleResource($role);
        return $this->successResponse($roleResource, 'Role created successfully', 201);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $roleResource = new RoleResource($role);
        return $this->successResponse($roleResource, 'Role details fetched successfully');
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions' => 'array'
        ]);

        $role = $this->roleService->updateRole($role, $data);
        $roleResource = new RoleResource($role);
        return $this->successResponse($roleResource, 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $this->roleService->deleteRole($role);
        return $this->successResponse('message', 'Role deleted successfully');
    }
}
