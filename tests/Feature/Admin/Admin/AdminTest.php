<?php

namespace Tests\Feature\Admin\Admin;

use App\Data\Admin\Admin\CreateAdmin\Request\CreateAdminRequestData;
use App\Enum\Auth\RolesEnum;
use App\Models\CourseTeacher;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class AdminTest extends AdminTestCase
{
    private string $main_route = '/admins/admins';

    protected function setUp(): void
    {
        parent::setUp();

    }

    #[Test]
    public function create_admin_with_201_response(): void
    {

        CourseTeacher::query()
            ->delete();

        $create_admin_request =
            new CreateAdminRequestData(
                'tamer',
                'tamer'
            );

        $assign_a_teacher_to_an_open_course_route = $this->main_route;

        $response =
            $this
                ->postJson(
                    $assign_a_teacher_to_an_open_course_route,
                    $create_admin_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_admin =
                User::query()
                    ->where(
                        'name',
                        $create_admin_request->name
                    )
                    ->first();

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

        $response = $this->deleteJson($show_route);

        $response->assertStatus(200);

        $deleted_admin = User::query()
            ->whereId($first_admin->id)
            ->first();

        $admin_has_been_deleted =
         $deleted_admin == null;

        $this->assertTrue($admin_has_been_deleted);

    }
}
