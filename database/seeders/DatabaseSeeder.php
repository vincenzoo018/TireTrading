<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ❌ Remove default factory-based seeding (it uses old columns)
        // User::factory(10)->create();

        // ✅ Call your custom seeders instead
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class, // keep this if you have a category seeder
        ]);
    }
}
