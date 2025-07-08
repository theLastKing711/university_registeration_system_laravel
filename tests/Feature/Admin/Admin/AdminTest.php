<?php

namespace Tests\Feature\Admin\Admin;

use App\Data\Admin\Admin\CreateAdmin\Request\CreateAdminRequestData;
use App\Enum\Auth\RolesEnum;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class AdminTest extends AdminTestCase
{
    protected function setUp(): void
    {

        parent::setUp();

        $this
            ->route_builder
            ->withPaths('admins');

    }

    #[Test]
    public function create_admin_with_201_response(): void
    {

        $create_admin_request =
            new CreateAdminRequestData(
                'tamer',
                'tamer'
            );

        $response =
            $this
                ->postJson(
                    $this
                        ->route_builder
                        ->build(),
                    $create_admin_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_admin =
                User::query()
                    ->firstWhere(
                        'name',
                        $create_admin_request
                            ->name
                    );

        $admin_has_been_created =
            $created_admin != null;

        $this
            ->assertTrue(
                $admin_has_been_created
            );

        $created_admin_has_admin_role =
            $created_admin->hasRole(RolesEnum::ADMIN);

        $this
            ->assertTrue(
                $created_admin_has_admin_role
            );

    }

    #[Test]
    public function delete_admin_with_200_response(): void
    {

        $first_admin =
            User::query()
                ->first();

        $show_route = $this->main_route.'/?ids[]='.$first_admin->id;

        $delete_admin_route =
            $this
                ->route_builder
                ->withArrayQueryParameter(
                    [$first_admin->id]
                )
                ->build();

        $response = $this->deleteJson($delete_admin_route);

        $response->assertStatus(200);

        $deleted_admin = User::query()
            ->whereId($first_admin->id)
            ->first();

        $admin_has_been_deleted =
         $deleted_admin == null;

        $this->assertTrue($admin_has_been_deleted);

    }
}
