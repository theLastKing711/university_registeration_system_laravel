<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Department;
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
                    'id' => 1,
                    'name' => 'Math1',
                    'code' => 'M1',
                    'is_active' => true,
                    'credits' => 2,
                    'classroom_course' => [
                        [
                            'course_id' => 1,
                            'classroom_id' => 1,
                            'day' => 2,
                            'from' => '08:00:00',
                            'to' => '10:00:00',
                        ],
                        [
                            'course_id' => 1,
                            'classroom_id' => 5,
                            'day' => 5,
                            'from' => '08:00:00',
                            'to' => '10:00:00',
                        ],
                    ],
                ],
                [
                    'id' => 2,
                    'name' => 'Math2',
                    'code' => 'M2',
                    'is_active' => true,
                    'credits' => 2,
                    'classroom_course' => [
                        [
                            'course_id' => 2,
                            'classroom_id' => 2,
                            'day' => 2,
                            'from' => '10:00:00',
                            'to' => '112:00:00',
                        ],
                        [
                            'course_id' => 2,
                            'classroom_id' => 6,
                            'day' => 3,
                            'from' => '08:00:00',
                            'to' => '10:00:00',
                        ],
                    ],
                ],
                [
                    'id' => 3,
                    'name' => 'Math3',
                    'code' => 'M3',
                    'is_active' => true,
                    'credits' => 2,
                    'classroom_course' => [
                        [
                            'course_id' => 3,
                            'classroom_id' => 3,
                            'day' => 4,
                            'from' => '08:00:00',
                            'to' => '10:00:00',
                        ],
                        [
                            'course_id' => 3,
                            'classroom_id' => 7,
                            'day' => 4,
                            'from' => '02:00:00',
                            'to' => '04:00:00',
                        ],
                    ],
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
                   'id',
                   $departments->pluck('id')
               )
               ->get();

        foreach (self::DEPARTMENTS as $department => $department_values) {
            $department_model =
             $departments_models
                 ->firstWhere(
                     'id',
                     $department_values['id']
                 );

            $courses = collect(
                $department_values['courses']
            );

            $courses_models =
                Course::query()
                    ->whereIn(
                        'id',
                        $courses->pluck('id')
                    )
                    ->get();

            $department_model
                ->courses()
                ->attach($courses_models->pluck('id'));

            // this insert them all in one go
            DB::table('classroom_course')
                ->insert(
                    $courses->pluck('classroom_course')->flatten(depth: 1)
                        ->toArray()
                );
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

        }
    }
}
