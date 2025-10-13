<?php

namespace Database\Seeders;

use App\Models\ShortContent;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            HeroContentSeeder::class,
            AboutContentSeeder::class,
            ShortContentSeeder::class,
            UpcomingContentSeeder::class,
            ContactContentSeeder::class,
            SiteSettingSeeder::class,
            SocialMediaSeeder::class,
            UserRolePermissionSeeder::class,
            PermissionSeeder::class
        ]);
    }
}
