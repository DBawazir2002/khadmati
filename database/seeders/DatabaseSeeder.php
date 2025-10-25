<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Role as RoleEnum;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        User::factory()->create([
            'name' => 'Admin',
            'phone' => '772219245',
            'password' => 'password',
            'address' => 'Yemen',
            'phone_verified_at' => now(),
        ])->assignRole(RoleEnum::ADMIN->value);
    }
}
