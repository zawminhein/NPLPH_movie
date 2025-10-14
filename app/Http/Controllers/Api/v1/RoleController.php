<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
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
        return $this->successResponse($roles, 'Roles fetched successfully');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = $this->roleService->createRole($data);
        return $this->successResponse($role, 'Role created successfully', 201);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return $this->successResponse($role, 'Role fetched successfully');
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions' => 'array'
        ]);

        $role = $this->roleService->updateRole($role, $data);
        return $this->successResponse($role, 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $this->roleService->deleteRole($role);
        return $this->successResponse(null, 'Role deleted successfully', 204);
    }
}
