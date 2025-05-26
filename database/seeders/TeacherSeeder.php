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
            'name' => 'hassan bama',
        ],
        [
            'id' => 2,
            'name' => 'bassam kossa',
        ],
        [
            'id' => 3,
            'name' => 'tamer hosny',
        ],
        [
            'id' => 4,
            'name' => 'thaer basha',
        ],
        [
            'id' => 5,
            'name' => 'hind azzrak',
        ],
        [
            'id' => 6,
            'name' => 'kiba bara',
        ],

    ];

    public function run(): void
    {
        Teacher::insert(self::TEACHERS);
    }
}
