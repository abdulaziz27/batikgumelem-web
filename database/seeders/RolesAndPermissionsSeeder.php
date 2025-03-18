<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Product permissions
            'create products',
            'edit products',
            'delete products',
            'view products',

            // Category permissions
            'create categories',
            'edit categories',
            'delete categories',
            'view categories',

            // Transaction permissions
            'view transactions',
            'process transactions',
            'cancel transactions',

            // Blog permissions
            'create blogs',
            'edit blogs',
            'delete blogs',
            'view blogs',
            'publish blogs',

            // User management
            'manage users',
            'view users',

            // Review management
            'approve reviews',
            'delete reviews',
            'view reviews',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $authorRole = Role::create(['name' => 'author']);
        $authorRole->givePermissionTo([
            'create blogs',
            'edit blogs',
            'view blogs',
            'delete blogs',
            'view products',
            'view categories',
            'view transactions',
            'view reviews'
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'view products',
            'view categories',
            'view blogs'
        ]);

        // Create demo admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Create demo author user
        $author = User::create([
            'name' => 'Author User',
            'email' => 'author@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $author->assignRole('author');

        // Create demo regular user
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('user');
    }
}
