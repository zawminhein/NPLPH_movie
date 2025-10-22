<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;

class PermissionsForRoleCreateService
{
     public function getPermissionsForRoleCreate()
    {
          $permissions = Permission::all();
        $grouped = [];

        foreach ($permissions as $permission) {
            // Split prefix (e.g. 'user', 'role', 'hero')
            $parts = explode('_', $permission->name, 2);
            $group = $parts[0]; // first part before underscore

            // Initialize group if not exists
            if (!isset($grouped[$group])) {
                $grouped[$group] = [];
            }

            // Append permission
            $grouped[$group][] = [
                'id' => $permission->id,
                'name' => $permission->name
            ];
        }

        return $grouped;
    }
}
