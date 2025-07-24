<?php

namespace Tests\Feature\Admin\Admin;

use App\Data\Admin\Admin\CreateAdmin\Request\CreateAdminRequestData;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class AdminTest extends AdminTestCase
{
    protected function setUp(): void
    {

        parent::setUp();

        $this
            ->withRoutePaths('admins');

    }

    #[Test]
    public function create_admin_with_200_response(): void
    {

        $create_admin_request =
            new CreateAdminRequestData(
                'tamer',
                'tamer'
            );

        $response =
            $this
                ->postJsonData(
                    $create_admin_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                User::class,
                [
                    'name' => $create_admin_request->name,
                ]
            );

    }

    #[Test]
    public function delete_admin_with_200_response(): void
    {

        $new_admin =
            User::factory()
                ->create();

        $this->withArrayQueryParameter([
            $new_admin->id,
        ]);

        $response =
            $this->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                User::class,
                [
                    'id' => $new_admin->id,
                ]
            );

    }
}
