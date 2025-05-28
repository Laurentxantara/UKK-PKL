<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin permissions
        Permission::create(['name' => 'manage users', 'guard_name' => 'web']);
        Permission::create(['name' => 'view siswa', 'guard_name' => 'web']);
        Permission::create(['name' => 'view guru', 'guard_name' => 'web']);
        Permission::create(['name' => 'assign role', 'guard_name' => 'web']);
        Permission::create(['name' => 'dashboard admin', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit profile', 'guard_name' => 'web']);

        // Guru permissions
        Permission::create(['name' => 'dashboard guru', 'guard_name' => 'web']);

        // Siswa permissions
        Permission::create(['name' => 'dashboard siswa', 'guard_name' => 'web']);
        Permission::create(['name' => 'add laporan pkl', 'guard_name' => 'web']);

     
    }
}
