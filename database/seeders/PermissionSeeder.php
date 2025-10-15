<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'user_view','user_create', 'user_update', 'user_delete',
            'role_view', 'role_create', 'role_update', 'role_delete',
            'hero_view', 'hero_edit', 'about_view', 'about_edit',
            'short_view', 'short_edit', 'upcoming_view', 'upcoming_edit',
            'activity_create', 'activity_view', 'activity_edit', 'activity_delete',
            'contact_view', 'contact_edit', 'site_setting_view', 'site_setting_edit',
            'social_media_view', 'social_media_edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
