<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public const CLASSROOMS = [
        [
            'id' => 1,
            'name' => 'A-1',
        ],
        [
            'id' => 2,
            'name' => 'A-2',
        ],
        [
            'id' => 3,
            'name' => 'A-3',
        ],
        [
            'id' => 4,
            'name' => 'A-4',
        ],
        [
            'id' => 5,
            'name' => 'B-1',
        ],
        [
            'id' => 6,
            'name' => 'B-2',
        ],
        [
            'id' => 7,
            'name' => 'B-3',
        ],
        [
            'id' => 8,
            'name' => 'B-4',
        ],
        [
            'id' => 9,
            'name' => 'c-1',
        ],
        [
            'id' => 10,
            'name' => 'c-2',
        ],
        [
            'id' => 11,
            'name' => 'c-3',
        ],
        [
            'id' => 12,
            'name' => 'c-4',
        ],

    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = array_map(fn ($class) => $class, self::CLASSROOMS);

        Classroom::insert(self::CLASSROOMS);
    }
}
