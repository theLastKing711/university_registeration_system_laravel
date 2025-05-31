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
        ],
        [
            'id' => 2,
            'name' => 'mousa',
        ],
        [
            'id' => 3,
            'name' => 'shaar',
        ],
        [
            'id' => 4,
            'name' => 'basheer kharat',
        ],
        [
            'id' => 5,
            'name' => 'sa3eed sa3dan',
        ],
        [
            'id' => 6,
            'name' => 'iman',
        ],
        [
            'id' => 7,
            'name' => 'black',
        ],

    ];

    public function run(): void
    {
        Teacher::insert(self::TEACHERS);
    }
}
