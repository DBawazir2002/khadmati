<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Role as RoleEnum;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // create permissions
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'view-users']);

        Permission::create(['name' => 'manage-services']);
        Permission::create(['name' => 'create-services']);
        Permission::create(['name' => 'edit-services']);
        Permission::create(['name' => 'view-services']);

        Permission::create(['name' => 'manage-offers']);
        Permission::create(['name' => 'create-offers']);
        Permission::create(['name' => 'edit-offers']);
        Permission::create(['name' => 'view-offers']);

        Permission::create(['name' => 'manage-categories']);
        Permission::create(['name' => 'create-categories']);
        Permission::create(['name' => 'edit-categories']);
        Permission::create(['name' => 'view-categories']);

        // Create Roles
        $adminRole = Role::create(['name' => RoleEnum::ADMIN->value]);

        $serviceProviderRole = Role::create(['name' => RoleEnum::WORKER->value]);

        $adminRole->givePermissionTo(
            Permission::query()->get()
        );

        $serviceProviderRole->givePermissionTo([
            'view-services',
            'view-offers',
            'view-categories',
        ]);
    }
}
