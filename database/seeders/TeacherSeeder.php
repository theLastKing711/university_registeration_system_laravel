<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public const TEACHERS = [
        [
            'id' => 1,
            'name' => 'aynman',
            'department_id' => 1,
        ],
        [
            'id' => 2,
            'name' => 'mousa',
            'department_id' => 1,
        ],
        [
            'id' => 3,
            'name' => 'shaar',
            'department_id' => 1,
        ],
        [
            'id' => 4,
            'name' => 'basheer kharat',
            'department_id' => 1,
        ],
        [
            'id' => 5,
            'name' => 'sa3eed sa3dan',
            'department_id' => 1,
        ],
        [
            'id' => 6,
            'name' => 'iman',
            'department_id' => 1,
        ],
        [
            'id' => 7,
            'name' => 'black',
            'department_id' => 1,
        ],

    ];

    public function run(): void
    {
        Teacher::insert(self::TEACHERS);
    }
}
