<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedAdmins();

        $this->seedCourseRegisterers();

        $this->seedMarkAssigner();
    }

    public function seedAdmins(): void
    {

        User::factory()
            ->staticAdmin()
            ->create();

        // User::factory()
        //     ->count(9)
        //     ->admin()
        //     ->create();
    }

    public function seedCourseRegisterers(): void
    {

        User::factory()
            ->staticCourseRegisterer()
            ->create();

    }

    public function seedMarkAssigner(): void
    {
        User::factory()
            ->staticMarkAssigner()
            ->create();
    }
}
