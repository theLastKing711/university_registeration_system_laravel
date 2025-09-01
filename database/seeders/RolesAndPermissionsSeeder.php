<?php

namespace Database\Seeders;

use App\Enum\Auth\PermissionsEnum;
use App\Enum\Auth\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->seedPermissions();

        $this->seedRoles();

    }

    private function seedPermissions()
    {
        $permissions =
          collect(
              PermissionsEnum::cases()
          )
              ->map(fn ($item) => ['name' => $item->value, 'guard_name' => 'web']);

        ModelsPermission::insert(
            $permissions
                ->toArray()
        );

    }

    private function seedRoles()
    {

        foreach (RolesEnum::cases() as $role_enum) {
            $role =
                Role::create(attributes: ['name' => $role_enum->value]);

            $role_permissions_ids =
                ModelsPermission::query()
                    ->whereIn(
                        'name',
                        collect(
                            $role_enum->permissions()
                        )
                            ->map(fn ($item) => $item->value)
                    )
                    ->get()
                    ->pluck('id');

            $role
                ->permissions()
                ->attach(
                    $role_permissions_ids
                );

        }

    }
}
