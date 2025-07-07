<?php

namespace Tests\Feature\Admin\Abstractions;

use App\Helpers\RotueBuilder\RouteBuilder;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AdminTestCase extends TestCase
{
    use RefreshDatabase;

    protected string $main_route = '/admin/users';

    public User $admin;

    protected RouteBuilder $route_builder;

    protected function setUp(): void
    {
        parent::setUp();

        //        parent::withHeader('Accept', 'application/json');

        $this->seed(RolesAndPermissionsSeeder::class);

        $this->CreateAdmin();

        $this->actingAs($this->admin);
    }

    private function CreateAdmin(): void
    {
        $this->admin =
            User::factory()
                ->staticAdmin()
                ->create();
    }

    // public function post($uri, $data = [], $headers = []): TestResponse
    // {
    //     return
    //         parent::withHeaders(['Accept' => 'application/json'])
    //             ->post($uri, $data, $headers);

    // }
}
