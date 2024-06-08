<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);

        $dashboardPermission = Permission::create(['name' => 'dashboard']);
        $walletsPermission = Permission::create(['name' => 'wallets']);
        $usersPermission = Permission::create(['name' => 'users']);

        $roleAdmin->givePermissionTo($dashboardPermission,$walletsPermission, $usersPermission);

        $roleUser->givePermissionTo($dashboardPermission,$walletsPermission);
    }
}
