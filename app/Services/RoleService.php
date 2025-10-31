<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RoleService
{
    /**
     * Get all roles with permissions
     */
    public function getAllRoles($data)
    {
        $perPage = $data->get('per_page', 10);
        return Role::with('permissions')->orderByDesc('id')->paginate($perPage);
    }

    /**
     * Get single role by ID
     */
    public function getRole($id)
    {
        return Role::with('permissions')->find($id);
    }

    /**
     * Create a new role
     */
    public function storeRole($data)
    {
        $role = Role::create(['name' => $data['name'], 'guard_name' => 'web']);

        $role->syncPermissions($data['permissions']);

        return $role;
    }

    /**
     * Update existing role
     */
    public function updateRole($role, $data)
    {
        $role->update(['name' => $data['name']]);

        $role->syncPermissions($data['permissions']);

        return $role;
    }

    /**
     * Delete role
     */
    public function deleteRole($role)
    {
        return $role->delete();
    }
}
