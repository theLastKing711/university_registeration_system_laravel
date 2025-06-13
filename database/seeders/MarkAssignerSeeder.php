<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class MarkAssignerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->staticMarkAssigner()
            ->create();
    }
}
