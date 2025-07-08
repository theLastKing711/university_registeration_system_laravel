<?php

namespace Tests\Feature\Student\Abstractions;

use App\Helpers\RotueBuilder\RouteBuilder;
use App\Models\User;
use Database\Factories\StudentFactory;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTestCase extends TestCase
{
    use RefreshDatabase;

    protected string $main_route = '/students';

    public User $student;

    protected RouteBuilder $route_builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->route_builder =
                RouteBuilder::withMainRoute($this->main_route);

        $this->seed(RolesAndPermissionsSeeder::class);

        $this->createStudent();

        // $this->actingAs($this->student);
    }

    private function createStudent(): void
    {
        $this->student =
            StudentFactory::staticStudent()
                ->create();
    }
}
