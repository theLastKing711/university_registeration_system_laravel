<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public const CLASSROOMS = [
        'A-1',
        'A-2',
        'A-3',
        'B-1',
        'B-2',
        'B-3',
        'C-1',
        'C-2',
        'C-3',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = array_map(fn (string $class) => ['name' => $class], self::CLASSROOMS);

        Classroom::insert($classrooms);
    }
}
