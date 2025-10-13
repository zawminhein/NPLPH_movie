<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Super Admin User
        $user = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Change in production
            ]
        );

        // 2. Create Super Admin Role
        $role = Role::firstOrCreate(['name' => 'super admin']);

        // 3. Create Permissions (or fetch existing ones)
        $permissions = Permission::all();

        // 4. Assign Permissions to Role
        $role->syncPermissions($permissions);

        // 5. Assign Role to User
        $user->assignRole($role);
    
    }
}
