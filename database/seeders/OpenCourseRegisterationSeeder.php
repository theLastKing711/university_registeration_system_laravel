<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\OpenCourseRegisteration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class OpenCourseRegisterationSeeder extends Seeder
{
    public const OPEN_COURSE_REGISTERATIONS = [
        [
            'data' => [
                'course_id' => 1,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 1,
                        'course_id' => 1,
                        'teacher_id' => 4,
                        'is_main_teacher' => true,
                    ],
                    [
                        'id' => 2,
                        'course_id' => 1,
                        'teacher_id' => 6,
                        'is_main_teacher' => false,
                    ],
                ],
                'classroom_teachers' => [
                    'data' => [
                        [
                            'classroom_id' => 3,
                            'course_teacher_id' => 1,
                            'day' => 3,
                            'from' => '10:00:00',
                            'to' => '12:00:00',
                        ],
                        [
                            'classroom_id' => 4,
                            'course_teacher_id' => 1,
                            'day' => 4,
                            'from' => '14:00:00',
                            'to' => '16:00:00',
                        ],
                        [
                            'classroom_id' => 8,
                            'course_teacher_id' => 2,
                            'day' => 3,
                            'from' => '08:00:00',
                            'to' => '10:00:00',
                        ],
                        [
                            'classroom_id' => 9,
                            'course_teacher_id' => 2,
                            'day' => 4,
                            'from' => '14:00:00',
                            'to' => '16:00:00',
                        ],

                    ],
                ],
            ],
        ],
        [
            'data' => [
                'course_id' => 2,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 3,
                        'course_id' => 2,
                        'teacher_id' => 4,
                        'is_main_teacher' => true,
                    ],
                    [
                        'id' => 4,
                        'course_id' => 1,
                        'teacher_id' => 6,
                        'is_main_teacher' => false,
                    ],
                ],
                'classroom_teachers' => [
                    'data' => [
                        [
                            'classroom_id' => 5,
                            'course_teacher_id' => 3,
                            'day' => 2,
                            'from' => '08:00:00',
                            'to' => '10:00:00',
                        ],
                        [
                            'classroom_id' => 7,
                            'course_teacher_id' => 3,
                            'day' => 2,
                            'from' => '10:00:00',
                            'to' => '12:00:00',
                        ],
                    ],
                ],
            ],
        ],
        [
            'data' => [
                'course_id' => 3,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 5,
                        'course_id' => 3,
                        'teacher_id' => 4,
                        'is_main_teacher' => true,
                    ],
                    [
                        'id' => 6,
                        'course_id' => 1,
                        'teacher_id' => 6,
                        'is_main_teacher' => false,
                    ],
                ],

            ],
        ],
        [
            'data' => [
                'course_id' => 4,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 7,
                        'course_id' => 4,
                        'teacher_id' => 5,
                        'is_main_teacher' => true,
                    ],
                ],

            ],
        ],
        [
            'data' => [
                'course_id' => 5,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 8,
                        'course_id' => 5,
                        'teacher_id' => 5,
                        'is_main_teacher' => true,
                    ],
                ],

            ],
        ],
        [
            'data' => [
                'course_id' => 6,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 9,
                        'course_id' => 6,
                        'teacher_id' => 5,
                        'is_main_teacher' => true,
                    ],
                ],

            ],
        ],
        [
            'data' => [
                'course_id' => 7,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 9,
                        'course_id' => 7,
                        'teacher_id' => 6,
                        'is_main_teacher' => true,
                    ],
                ],

            ],
        ],
        [
            'data' => [
                'course_id' => 8,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 10,
                        'course_id' => 8,
                        'teacher_id' => 6,
                        'is_main_teacher' => true,
                    ],
                ],

            ],
        ],
        [
            'data' => [
                'course_id' => 9,
                'year' => 2014,
                'semester' => 0,
            ],
            'teachers' => [
                'data' => [
                    [
                        'id' => 11,
                        'course_id' => 9,
                        'teacher_id' => 6,
                        'is_main_teacher' => true,
                    ],
                ],

            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(StripeClient $stripe): void
    {

        $open_course_premissions_to_insert =
           Course::all()
               ->map(function (Course $course) {

                   $open_courses =
                       OpenCourseRegisteration::factory()
                           ->openFrom2014To2016ForEachSequence()
                        //    ->hasTwoTeachers()
                           ->create([
                               'course_id' => $course->id,
                               //    'semester' => fake()->numberBetween(0, 2),
                           ]);

                   //    $open_courses
                   //        ->each(function ($open_course) use ($stripe) {
                   //            $stripe
                   //                ->products
                   //                ->create([
                   //                    'id' => $open_course->id,
                   //                    'name' => $open_course->course->name,
                   //                ]);

                   //            // one-time purchase pricing
                   //            $stripe
                   //                ->prices
                   //                ->create([
                   //                    'product' => $open_course->id,
                   //                    'unit_amount' => $open_course->price_in_usd * 100,
                   //                    'currency' => 'usd',
                   //                    // 'lookup_key' => 'standard_monthly',
                   //                ]);
                   //        });

                   return $open_courses;
               });

        Context::add(
            OpenCourseRegisteration::class,
            OpenCourseRegisteration::all()
        );

        // $courses = collect(self::OPEN_COURSE_REGISTERATIONS);

        // OpenCourseRegisteration::insert(
        //     $courses
        //         ->pluck('data')
        //         ->toArray()
        // );

        // DB::table('course_teacher')
        //     ->insert(
        //         $courses
        //             ->pluck('teachers.data')
        //             ->flatten(1)
        //             ->toArray()
        //     );

    }

    private function CreateStripeProduct(StripeClient $stripe, $open_course)
    {
        $stripe
            ->products
            ->create([
                'id' => $open_course->id,
                'name' => $open_course->course->name,
            ]);

        // one-time purchase pricing
        $stripe
            ->prices
            ->create([
                'product' => $open_course->id,
                'unit_amount' => $open_course->price_in_usd * 100,
                'currency' => 'usd',
                // 'lookup_key' => 'standard_monthly',
            ]);
    }
}
