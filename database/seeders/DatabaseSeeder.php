<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 🔹 Create base roles for CMS One
        $roles = [
            'super-admin',
            'admin',
            'user',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // 🔹 Optional permissions (for later use)
        $permissions = [
            'view documents',
            'approve admin requests',
            'upload documents',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // 🔹 Create Super Admin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@cms1.local'],
            [
                'name' => 'Super Admin 💚',
                'password' => bcrypt('cms1admin@123'), // 🔒 default password
            ]
        );

        $superAdmin->assignRole('super-admin');

        // 🔹 Create Test Admin & User
        $admin = User::firstOrCreate(
            ['email' => 'admin@cms1.local'],
            [
                'name' => 'Admin Tester',
                'password' => bcrypt('cms1admin@123'),
            ]
        );
        $admin->assignRole('admin');

        $user = User::firstOrCreate(
            ['email' => 'user@cms1.local'],
            [
                'name' => 'Sample User',
                'password' => bcrypt('cms1user@123'),
            ]
        );
        $user->assignRole('user');

        // 🔹 Show terminal confirmation
        $this->command->info("✅ Roles & Super Admin seeded successfully, Jigili Jan 💚");
        $this->command->info("➡️ Login with superadmin@cms1.local / cms1admin@123");
    }
}
