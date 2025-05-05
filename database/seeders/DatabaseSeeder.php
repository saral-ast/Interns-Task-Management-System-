<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $internRole = Role::create(['name' => 'intern']);

        // Create test user with intern role
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role_id' => $internRole->id,
        ]);

        // Create admin user with admin role
        Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        // Optionally: seed permissions and assign to roles if needed
        // $permission = Permission::create(['name' => 'manage-users']);
        // $adminRole->permissions()->attach($permission->id);
    }
}