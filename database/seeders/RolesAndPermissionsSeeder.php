<?php

namespace Database\Seeders;

use App\Enum\Auth\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (RolesEnum::cases() as $role) {
            Role::create(['name' => $role->value]);
        }
    }
}
