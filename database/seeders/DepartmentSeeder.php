<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public const DEPARTMENTS_DATA = [
        [
            'name' => 'IT',
        ],
        [
            'name' => 'English',
        ],
        [
            'name' => 'Biology',
        ],
    ];

    // seed others first tommowrw example: courses = ['math1', 'math2', 'math3',] seed it then classrooms = ['a-1', 'a-2', 'a-3'] run seeder then
    // after that we come here attach values to parents
    public const DEPARTMENTS = [
        [
            'name' => 'IT',
            'courses' => [
                [
                    'name' => 'MATH1',
                    'code' => 'M1',
                    'is_active' => true,
                    'credits' => 2,
                    // 'classrooms' => [
                    //     [
                    //         '',
                    //     ],
                    // ],
                ],
                [
                    'name' => 'MATH2',
                    'code' => 'M2',
                    'is_active' => true,
                    'credits' => 2,
                ],
                [
                    'name' => 'MATH3',
                    'code' => 'M3',
                    'is_active' => true,
                    'credits' => 2,
                ],
            ],
        ],
        [
            'name' => 'English',
            'courses' => [
                [
                    'name' => 'English1',
                    'code' => 'E1',
                    'is_active' => true,
                    'credits' => 2,
                ],
                [
                    'name' => 'English2',
                    'code' => 'E2',
                    'is_active' => true,
                    'credits' => 2,
                ],
                [
                    'name' => 'English3',
                    'code' => 'E3',
                    'is_active' => true,
                    'credits' => 2,
                ],
            ],
        ],
        [
            'name' => 'Biology',
            'courses' => [
                [
                    'name' => 'Bio1',
                    'code' => 'B1',
                    'is_active' => true,
                    'credits' => 2,
                ],
                [
                    'name' => 'Bio2',
                    'code' => 'B2',
                    'is_active' => true,
                    'credits' => 2,
                ],
                [
                    'name' => 'Bio3',
                    'code' => 'B3',
                    'is_active' => true,
                    'credits' => 2,
                ],
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Department::insert(self::DEPARTMENTS_DATA);

        $departments = collect(self::DEPARTMENTS);

        $departments_models =
           Department::query()
               ->whereIn(
                   'name',
                   $departments->pluck('name')
               )
               ->get();

        foreach (self::DEPARTMENTS as $department => $department_values) {
            $department_model =
             $departments_models
                 ->firstWhere(
                     'name',
                     $department_values['name']
                 );

            $courses_models =
                Course::query()
                    ->whereIn('name', collect($department_values['courses'])->pluck('name'))
                    ->get();

            $department_model
                ->courses()
                ->attach($courses_models->pluck('id'));

        }
    }
}
