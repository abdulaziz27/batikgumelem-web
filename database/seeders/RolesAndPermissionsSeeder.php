<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Reset cached roles
       app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

       // Create roles
       $adminRole = Role::create(['name' => 'admin']);
       $userRole = Role::create(['name' => 'user']);

       // Create demo admin user
       $admin = User::create([
           'name' => 'Admin User',
           'email' => 'admin@gmail.com',
           'password' => Hash::make('password'),
       ]);
       $admin->assignRole('admin');

       // Create demo regular user
       $user = User::create([
           'name' => 'Regular User',
           'email' => 'user@gmail.com',
           'password' => Hash::make('password'),
       ]);
       $user->assignRole('user');

    }
}
