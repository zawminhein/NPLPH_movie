<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\PermissionsForRoleCreateService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use ApiResponseTrait;
    protected $permissionService;

    public function __construct(PermissionsForRoleCreateService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    public function index()
    {
        $permissionService = $this->permissionService->getPermissionsForRoleCreate();
        return $this->successResponse($permissionService, 'Permissions fetched successfully');
    }
}
