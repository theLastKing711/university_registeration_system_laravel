<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public const TEACHERS = [
        [
            'name' => 'aynman',
        ],
        [
            'name' => 'mousa',
        ],
        [
            'name' => 'shaar',
        ],
        [
            'name' => 'basheer kharat',
        ],
        [
            'name' => 'sa3eed sa3dan',
        ],
        [
            'name' => 'iman',
        ],
        [
            'name' => 'black',
        ],

    ];

    public function run(): void
    {
        $it_department_id =
            Department::query()
                ->firstWhere(
                    'name',
                    'IT'
                )
                ->id;

        $teachers =
                collect(
                    self::TEACHERS
                )
                    ->map(function ($teacher) use ($it_department_id) {
                        return
                            [
                                ...$teacher,
                                'department_id' => $it_department_id,
                            ];
                    })
                    ->toArray();

        Teacher::insert($teachers);
    }
}
