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
            'hero_view', 'hero_update', 'about_view', 'about_update',
            'short_view', 'short_update', 'upcoming_view', 'upcoming_update',
            'activity_create', 'activity_view', 'activity_update', 'activity_delete',
            'contact_view', 'contact_update', 'site_setting_view', 'site_setting_update',
            'social_media_view', 'social_media_update',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
