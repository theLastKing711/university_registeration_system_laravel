<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public const DEPARTMENTS_DATA = [
        [
            'id' => 1,
            'name' => 'IT',
        ],
        [
            'id' => 2,
            'name' => 'English',
        ],
        [
            'id' => 3,
            'name' => 'Biology',
        ],
    ];

    // seed others first tommowrw example: courses = ['math1', 'math2', 'math3',] seed it then classrooms = ['a-1', 'a-2', 'a-3'] run seeder then
    // after that we come here attach values to parents
    public const DEPARTMENTS = [
        [
            'id' => 1,
            'name' => 'IT',
            'courses' => [
                [
                    'data' => [
                        'id' => 1,
                        'name' => 'Math1',
                        'code' => 'M1',
                        'is_active' => true,
                        'credits' => 2,
                    ],
                    'open_registerations' => [
                        [
                            'data' => [
                                'id' => 1,
                                'course_id' => 1,
                                'year' => 2014,
                                'semester' => 0,
                            ],
                            'teachers' => [
                                [
                                    'data' => [
                                        'id' => 1,
                                        'course_id' => 1,
                                        'teacher_id' => 4,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 1,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 1,
                                                'day' => 2,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 2,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 1,
                                                'day' => 2,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'data' => [
                                        'id' => 2,
                                        'course_id' => 1,
                                        'teacher_id' => 7,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 3,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 2,
                                                'day' => 3,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 4,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 2,
                                                'day' => 3,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'data' => [
                                'id' => 2,
                                'course_id' => 1,
                                'year' => 2015,
                                'semester' => 0,
                            ],
                            'teachers' => [
                                [
                                    'data' => [
                                        'id' => 3,
                                        'course_id' => 2,
                                        'teacher_id' => 4,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 5,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 3,
                                                'day' => 4,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 6,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 3,
                                                'day' => 4,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'data' => [
                                        'id' => 4,
                                        'course_id' => 2,
                                        'teacher_id' => 7,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 7,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 4,
                                                'day' => 5,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 8,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 4,
                                                'day' => 5,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'data' => [
                                'id' => 3,
                                'course_id' => 1,
                                'year' => 2016,
                                'semester' => 0,
                            ],
                            'teachers' => [
                                [
                                    'data' => [
                                        'id' => 5,
                                        'course_id' => 3,
                                        'teacher_id' => 4,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 9,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 5,
                                                'day' => 6,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 10,
                                                'classroom_id' => 1,
                                                'course_teacher_id' => 5,
                                                'day' => 6,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'data' => [
                                        'id' => 6,
                                        'course_id' => 3,
                                        'teacher_id' => 7,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 11,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 6,
                                                'day' => 2,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 12,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 6,
                                                'day' => 2,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'data' => [
                                'id' => 4,
                                'course_id' => 1,
                                'year' => 2017,
                                'semester' => 0,
                            ],
                            'teachers' => [
                                [
                                    'data' => [
                                        'id' => 7,
                                        'course_id' => 4,
                                        'teacher_id' => 4,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 13,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 7,
                                                'day' => 3,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 14,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 7,
                                                'day' => 3,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'data' => [
                                        'id' => 8,
                                        'course_id' => 4,
                                        'teacher_id' => 7,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 15,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 8,
                                                'day' => 4,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 16,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 8,
                                                'day' => 4,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'data' => [
                                'id' => 5,
                                'course_id' => 1,
                                'year' => 2018,
                                'semester' => 0,
                            ],
                            'teachers' => [
                                [
                                    'data' => [
                                        'id' => 9,
                                        'course_id' => 5,
                                        'teacher_id' => 4,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 17,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 9,
                                                'day' => 5,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 18,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 9,
                                                'day' => 5,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'data' => [
                                        'id' => 10,
                                        'course_id' => 5,
                                        'teacher_id' => 7,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 19,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 10,
                                                'day' => 6,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 20,
                                                'classroom_id' => 2,
                                                'course_teacher_id' => 10,
                                                'day' => 6,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'data' => [
                                'id' => 6,
                                'course_id' => 1,
                                'year' => 2019,
                                'semester' => 0,
                            ],
                            'teachers' => [
                                [
                                    'data' => [
                                        'id' => 11,
                                        'course_id' => 6,
                                        'teacher_id' => 4,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 21,
                                                'classroom_id' => 3,
                                                'course_teacher_id' => 11,
                                                'day' => 2,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 22,
                                                'classroom_id' => 3,
                                                'course_teacher_id' => 11,
                                                'day' => 2,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'data' => [
                                        'id' => 12,
                                        'course_id' => 6,
                                        'teacher_id' => 7,
                                        'is_main_teacher' => true,
                                    ],
                                    'classrooms' => [
                                        [
                                            'data' => [
                                                'id' => 23,
                                                'classroom_id' => 3,
                                                'course_teacher_id' => 12,
                                                'day' => 3,
                                                'from' => '08:00:00',
                                                'to' => '09:30:00',
                                            ],
                                        ],
                                        [
                                            'data' => [
                                                'id' => 24,
                                                'classroom_id' => 3,
                                                'course_teacher_id' => 12,
                                                'day' => 3,
                                                'from' => '10:00:00',
                                                'to' => '11:00:00',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                // [
                //     'data' => [
                //         'id' => 2,
                //         'name' => 'Math2',
                //         'code' => 'M2',
                //         'is_active' => true,
                //         'credits' => 2,
                //     ],

                // ],
                // [
                //     'id' => 3,
                //     'name' => 'Math3',
                //     'code' => 'M3',
                //     'is_active' => true,
                //     'credits' => 2,
                // ],
            ],
        ],

    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $departments = collect(self::DEPARTMENTS);

        Department::insert(self::DEPARTMENTS_DATA);

        $courses =
            $departments
                ->pluck('courses')
                ->flatten(1);

        Course::insert(
            $courses
                ->pluck('data')
                ->toArray()
        );

        $open_course_registerations =
            $courses
                ->pluck('open_registerations')
                ->flatten(1);

        DB::table('open_course_registerations')
            ->insert(
                $open_course_registerations
                    ->pluck('data')
                    ->toArray()
            );

        $teachers =
            $open_course_registerations
                ->pluck('teachers')
                ->flatten(1);

        DB::table('course_teacher')
            ->insert(
                $teachers
                    ->pluck('data')
                    ->toArray()
            );

        $classrooms =
            $teachers
                ->pluck('classrooms')
                ->flatten(1);

        DB::table('classroom_course_teacher')
            ->insert(
                $classrooms
                    ->pluck('data')
                    ->toArray()
            );
        // $x =
        // $departments
        //     ->pluck('courses')
        //     ->flatten(1);

        // Department::factory()
        //     ->has(`
        //         Teacher::factory()
        //             ->seedFromItDepartment()
        //             ->hasAttached(

        //             )
        //     )
        //     ->has(
        //         //     Course::factory(
        //         //         $departments
        //         //             ->pluck('courses')
        //         //             ->flatten(1)
        //         //             ->toArray()
        //         //     )
        //         Course::factory()
        //             ->forEachSequence(
        //                 ...$x
        //             )

        //     )
        //     ->createMany(
        //         $departments->select('id', 'name')
        // );

        // $departments->each(function ( $department) use ($departments) {
        //     $x = Department
        //             ::factory()
        //             ->has(
        //                 Course::factory()
        //             )
        //         ->create($department)
        //             };

        // $departments_models =
        //    Department::query()
        //        ->whereIn(
        //            'id',
        //            $departments->pluck('id')
        //        )
        //        ->get();

        // foreach (self::DEPARTMENTS as $department => $department_values) {
        //     $department_model =
        //      $departments_models
        //          ->firstWhere(
        //              'id',
        //              $department_values['id']
        //          );

        //     $courses = collect(
        //         $department_values['courses']
        //     );

        //     $courses_models =
        //         Course::query()
        //             ->whereIn(
        //                 'id',
        //                 $courses->pluck('id')
        //             )
        //             ->get();

        //     $department_model
        //         ->courses()
        //         ->attach($courses_models->pluck('id'));

        // this insert them all in one go
        // DB::table('classroom_course')
        //     ->insert(
        //         $courses->pluck('classroom_course')->flatten(depth: 1)
        //             ->toArray()
        //     );
        // or
        // $courses->each(function ($course) {

        //     DB::table('classroom_course')
        //         ->insert($course['classroom_course']);
        // });

        // $courses->each(function ($course) {
        //     $classrooms =
        //         collect($course['classrooms']);

        //     $classrooms_models =
        //         Classroom::query()
        //             ->whereIn(
        //                 'name',
        //                 values: $classrooms->pluck('name')
        //             )
        //             ->get();

        //     $course_model =
        //             $courses_models
        //                 ->firstWhere(
        //                     'name',
        //                     $course['name']
        //                 );

        //     $course_classrooms_to_attach = [];

        //     $course_model
        //         ->classrooms()
        //         ->attach(
        //             $classrooms_models
        //                     ->pluck('id'),
        //             $classrooms
        //                             ->pluck('pivot')
        //                             ->toArray()
        //         );

        // });

        // }
    }
}
