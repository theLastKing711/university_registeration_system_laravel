<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use App\Models\OpenCourseRegisteration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public const DEPARTMENTS_DATA = [
        [
            'id' => 1,
            'name' => 'IT',
            'is_course_registeration_open' => true,
        ],
        [
            'id' => 2,
            'name' => 'English',
            'is_course_registeration_open' => true,

        ],
        [
            'id' => 3,
            'name' => 'Biology',
            'is_course_registeration_open' => true,

        ],
        [
            'id' => 4,
            'name' => 'Shared', // houses shared courses like arabic or english across all departments.
            'is_course_registeration_open' => true,
        ],
        [
            'id' => 5,
            'name' => 'Architecture',
            'is_course_registeration_open' => true,

        ],
    ];

    // seed others first tommowrw example: courses = ['math1', 'math2', 'math3',] seed it then classrooms = ['a-1', 'a-2', 'a-3'] run seeder then
    // after that we come here attach values to parents

    public const DEPARTMENTS = [
        [
            'data' => [
                'id' => 1,
                'name' => 'IT',
                'is_course_registeration_open' => true,
                'course_registeration_year' => 2014,
                'course_registeration_semester' => 0,
            ],
            'courses' => [
                [
                    'data' => [
                        'id' => 1,
                        'department_id' => 1,
                        'name' => 'Math1',
                        'code' => 'M1',
                        'credits' => 3,
                        'open_for_students_in_year' => 1,
                    ],
                    'prerequisites' => [],
                    'cross_listed_courses' => [],
                ],
                [
                    'data' => [
                        'id' => 2,
                        'department_id' => 1,
                        'name' => 'Math2',
                        'code' => 'M2',
                        'credits' => 3,
                        'open_for_students_in_year' => 1,
                    ],
                    'prerequisites' => [
                        [
                            'course_id' => 2,
                            'prerequisite_id' => 1,
                        ],
                    ],
                    'cross_listed_courses' => [],
                ],
                [
                    'data' => [
                        'id' => 3,
                        'department_id' => 1,
                        'name' => 'Math3',
                        'code' => 'M3',
                        'credits' => 3,
                        'open_for_students_in_year' => 2,
                    ],
                    'prerequisites' => [
                        [
                            'course_id' => 3,
                            'prerequisite_id' => 2,
                        ],
                    ],
                    'cross_listed_courses' => [],
                ],
                [
                    'data' => [
                        'id' => 10,
                        'department_id' => 1,
                        'name' => 'Electronics1',
                        'code' => 'ELCTR1',
                        'credits' => 3,
                        'open_for_students_in_year' => 2,
                    ],
                    'prerequisites' => [],
                    'cross_listed_courses' => [],
                ],
                [
                    'data' => [
                        'id' => 11,
                        'department_id' => 1,
                        'name' => 'Electronics2',
                        'code' => 'ELCTR2',
                        'credits' => 3,
                        'open_for_students_in_year' => 3,
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
                    'cross_listed_courses' => [],
                ],
                [
                    'data' => [
                        'id' => 12,
                        'department_id' => 1,
                        'name' => 'ITEng100',
                        'code' => 'ITEng100',
                        'credits' => 3,
                        'open_for_students_in_year' => 3,
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
                    'cross_listed_courses' => [
                        [
                            'first_course_id' => 12,
                            'second_course_id' => 100,
                        ],
                    ],
                ],
            ],

        ],
        [
            'data' => [
                'id' => 2,
                'name' => 'Architecture',
                'is_course_registeration_open' => true,
                'course_registeration_year' => 2014,
                'course_registeration_semester' => 0,
            ],
            'courses' => [
                [
                    'data' => [
                        'id' => 100,
                        'department_id' => 2,
                        'name' => 'ArchEngTheo100',
                        'code' => 'ArchEngTheo100',
                        'credits' => 3,
                        'open_for_students_in_year' => 1,
                    ],
                    'prerequisites' => [],
                    'cross_listed_courses' => [],
                ],
            ],

        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $departments = collect(
            DepartmentSeeder::DEPARTMENTS
        );

        Department::insert(
            $departments
                ->pluck('data')
                ->toArray()
        );

        // $departments = collect(self::DEPARTMENTS);

        // $courses =
        //     $departments
        //         ->pluck('courses')
        //         ->flatten(1);

        // Course::insert(
        //     $courses
        //         ->pluck(value: 'data')
        //         ->toArray()
        // );

        // $course_prequisites =
        //     $courses
        //         ->pluck('prerequisites')
        //         ->flatten(1);

        // DB::table('prerequisites')
        //     ->insert(
        //         $course_prequisites
        //             ->toArray()
        //     );

        // we didn't use afterMaking and batch insert because insert doesn't trigger after creating
        // $open_course_premissions_to_insert =
        //     Course::all()
        //         ->map(function (Course $course) {

        //             return
        //                 OpenCourseRegisteration::factory()
        //                     ->openFrom2014To2015()
        //                     ->hasTwoTeachers()
        //                     ->create([
        //                         'course_id' => $course->id,
        //                         'semester' => fake()->numberBetween(0, 2),
        //                     ]);
        //         });

    }
}
