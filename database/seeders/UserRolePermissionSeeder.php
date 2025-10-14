<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Create Super Admin user
        $user = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2️⃣ Create Super Admin role (with sanctum guard)
        $role = Role::firstOrCreate([
            'name' => 'super admin',
            'guard_name' => 'sanctum',
        ]);

        // 3️⃣ Assign all permissions to the role
        $role->syncPermissions(Permission::all());

        // 4️⃣ Assign role to user
        $user->assignRole($role);
    }
}
