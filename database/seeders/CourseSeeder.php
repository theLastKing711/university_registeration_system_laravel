<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public const IT_COURSES = [
        [
            'data' => [
                'id' => 1,
                'name' => 'Math1',
                'code' => 'M1',
                'credits' => 2,
            ],
            'prerequisites' => [],
        ],
        [
            'data' => [
                'id' => 2,
                'name' => 'Math2',
                'code' => 'M2',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 2,
                    'prerequisite_id' => 1,
                ],
            ],
        ],
        [
            'data' => [
                'id' => 3,
                'name' => 'Math3',
                'code' => 'M3',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 3,
                    'prerequisite_id' => 2,
                ],
            ],
        ],
        [
            'data' => [
                'id' => 10,
                'name' => 'Electronics1',
                'code' => 'ELCTR1',
                'credits' => 2,
            ],
            'prerequisites' => [],
        ],
        [
            'data' => [
                'id' => 11,
                'name' => 'Electronics2',
                'code' => 'ELCTR2',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 11,
                    'prerequisite_id' => 3,
                ],
                [
                    'course_id' => 11,
                    'prerequisite_id' => 10,
                ],
            ],
        ],
    ];

    public const COURSES = [

        // IT COURSES
        [
            'data' => [
                'id' => 1,
                'name' => 'Math1',
                'code' => 'M1',
                'credits' => 2,
            ],
            'prerequisites' => [],
        ],
        [
            'data' => [
                'id' => 2,
                'name' => 'Math2',
                'code' => 'M2',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 2,
                    'prerequisite_id' => 1,
                ],
            ],
        ],
        [
            'data' => [
                'id' => 3,
                'name' => 'Math3',
                'code' => 'M3',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 3,
                    'prerequisite_id' => 2,
                ],
            ],
        ],
        [
            'data' => [
                'id' => 10,
                'name' => 'Electronics1',
                'code' => 'ELCTR1',
                'credits' => 2,
            ],
            'prerequisites' => [],
        ],
        [
            'data' => [
                'id' => 11,
                'name' => 'Electronics2',
                'code' => 'ELCTR2',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 11,
                    'prerequisite_id' => 3,
                ],
                [
                    'course_id' => 11,
                    'prerequisite_id' => 10,
                ],
            ],
        ],

        // ENGLISH COURSES
        [
            'data' => [
                'id' => 4,
                'name' => 'English1',
                'code' => 'E1',
                'credits' => 2,
            ],
            'prerequisites' => [],
        ],
        [
            'data' => [
                'id' => 5,
                'name' => 'English2',
                'code' => 'E2',
                'credits' => 2,

            ],
            'prerequisites' => [
                [
                    'course_id' => 5,
                    'prerequisite_id' => 4,
                ],
            ],
        ],
        [
            'data' => [
                'id' => 6,
                'name' => 'English3',
                'code' => 'E3',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 6,
                    'prerequisite_id' => 5,
                ],
            ],
        ],

        // BIO COURSES
        [
            'data' => [
                'id' => 7,
                'name' => 'Bio1',
                'code' => 'B1',
                'credits' => 2,
            ],
            'prerequisites' => [],
        ],
        [
            'data' => [
                'id' => 8,
                'name' => 'Bio2',
                'code' => 'B2',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 8,
                    'prerequisite_id' => 7,
                ],
            ],
        ],
        [
            'data' => [
                'id' => 9,
                'name' => 'Bio3',
                'code' => 'B3',
                'credits' => 2,
            ],
            'prerequisites' => [
                [
                    'course_id' => 9,
                    'prerequisite_id' => 8,
                ],
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $departments = collect(DepartmentSeeder::DEPARTMENTS);

        $courses =
            $departments
                ->pluck('courses')
                ->flatten(1);

        Course::insert(
            $courses
                ->pluck(value: 'data')
                ->toArray()
        );

        $course_prequisites =
            $courses
                ->pluck('prerequisites')
                ->flatten(1);

        DB::table('prerequisites')
            ->insert(
                $course_prequisites
                    ->toArray()
            );

        $cross_listed_courses =
            $courses
                ->pluck('cross_listed_courses')
                ->flatten(1);

        DB::table('cross_listed_courses')
            ->insert(
                $cross_listed_courses
                    ->toArray()
            );
    }
}
