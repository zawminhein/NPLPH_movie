<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RoleService
{
    /**
     * Get all roles with permissions
     */
    public function getAllRoles()
    {
        return Role::with('permissions')->latest()->get();
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
    public function createRole($data)
    {
        $role = Role::create(['name' => $data['name']]);

        if (!empty($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

        return $role;
    }

    /**
     * Update existing role
     */
    public function updateRole($role, $data)
    {
        $role->update(['name' => $data['name']]);

        if (!empty($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

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
