<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Department;
use App\Models\OpenCourseRegisteration;
use App\Models\Teacher;
use Carbon\Carbon;
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
                'course_registeration_semester' => 2014,
            ],
            'courses' => [
                [
                    'data' => [
                        'id' => 1,
                        'department_id' => 1,
                        'name' => 'Math1',
                        'code' => 'M1',
                        'credits' => 2,
                    ],
                    'prerequisites' => [],
                    // 'opens' => [
                    //     'course_id' => 1,
                    //     'year' => Carbon::createFromFormat('Y', 2014)->toDateTimeString(),
                    //     'semester' => 0
                    // ]
                ],
                [
                    'data' => [
                        'id' => 2,
                        'department_id' => 1,
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
                        'department_id' => 1,
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
                        'department_id' => 1,
                        'name' => 'Electronics1',
                        'code' => 'ELCTR1',
                        'credits' => 2,
                    ],
                    'prerequisites' => [],
                ],
                [
                    'data' => [
                        'id' => 11,
                        'department_id' => 1,
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
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $departments = collect(self::DEPARTMENTS);

        // Department::insert(
        //     $departments
        //         ->pluck('data')
        //         ->toArray()
        // );

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

        // we didn't use afterMaking and batch insert because insert doesn't trigger after creating
        $open_course_premissions_to_insert =
            Course::all()
                ->map(function (Course $course) {

                    return
                        OpenCourseRegisteration::factory()
                            ->openFrom2014To2015()
                            ->hasTwoTeachers()
                            ->create([
                                'course_id' => $course->id,
                                'semester' => fake()->numberBetween(0, 2),
                            ]);
                });

        // OpenCourseRegisteration::insert(
        //     $open_course_premissions_to_insert
        //         ->flatten(1)
        //         ->toArray()
        // );

        // $open_course_registerations =
        //     $courses
        //         ->pluck('open_registerations')
        //         ->flatten(1);`

        // DB::table('open_course_registerations')
        //     ->insert(
        //         $open_course_registerations
        //             ->pluck('data')
        //             ->toArray()
        //     );

        // $teachers =
        //     $open_course_registerations
        //         ->pluck('teachers')
        //         ->flatten(1);

        // DB::table('course_teacher')
        //     ->insert(
        //         $teachers
        //             ->pluck('data')
        //             ->toArray()
        //     );

        // $classrooms =
        //     $teachers
        //         ->pluck('classrooms')
        //         ->flatten(1);

        // DB::table('classroom_course_teacher')
        //     ->insert(
        //         $classrooms
        //             ->pluck('data')
        //             ->toArray()
        //     );

        // $exams =
        //     $teachers
        //         ->pluck('exams')
        //         ->flatten(1);

        // DB::table('exams')
        //     ->insert(
        //         $exams
        //             ->pluck('data')
        //             ->toArray()
        //     );

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
