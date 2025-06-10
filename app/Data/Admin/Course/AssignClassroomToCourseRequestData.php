<?php

namespace App\Data\Admin\Course;

use App\Models\ClassroomCourseTeacher;
use App\Models\CourseTeacher;
use Carbon\Carbon;
use Closure;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Bail;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class AssignClassroomToCourseRequestData extends Data
{
    public function __construct(

        #[
            OAT\Property,
            Exists('course_teacher', 'id')
        ]
        public int $course_teacher_id,

        #[
            OAT\Property,
            Exists('classrooms', 'id')
        ]
        public int $classroom_id,

        #[OAT\Property, In([0, 1, 2, 3, 4, 5, 6, 7])]
        public int $day,

        #[WithCast(DateTimeInterfaceCast::class)]
        #[
            OAT\Property,
            Bail,
            DateFormat('H:i:s'),
        ]
        public string $from,

        #[WithCast(DateTimeInterfaceCast::class)]
        #[
            OAT\Property,
            Bail,
            DateFormat('H:i:s')
        ]
        public string $to,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'from' => [

                function (string $attribute, mixed $value, Closure $fail) use ($context) {

                    $request_classroom_id = $context->payload['classroom_id'];

                    $request_course_teacher_id = $context->payload['course_teacher_id'];

                    $request_day = $context->payload['day'];

                    $request_from = $context->payload['from'];

                    $request_to = $context->payload['to'];

                    // $request_from = Carbon::parse($context->payload['from']);

                    // $request_to = Carbon::parse($context->payload['to']);

                    $course_teacher =
                        CourseTeacher::query()
                            ->with('course')
                            ->firstWhere(
                                'id',
                                $request_course_teacher_id
                            );

                    $course_year = $course_teacher->course->year;

                    $course_semester = $course_teacher->course->semester;

                    $overlapped_time_classrooms = ClassroomCourseTeacher::query()
                        // ->with(
                        //     [
                        //         'courseTeacher.course',
                        //     ]
                        // )
                        ->whereRelation('courseTeacher.course', 'year', $course_year)
                        ->whereRelation('courseTeacher.course', 'semester', $course_semester)
                        ->where('classroom_id', $request_classroom_id)
                        ->where('day', $request_day)
                        ->whereNested(function ($query) use ($request_from, $request_to) {
                            $query
                                ->whereNested(function ($query) use ($request_from, $request_to) {
                                    $query
                                        ->whereTime('from', '>=', $request_from)
                                        ->whereTime('from', '<=', $request_to);
                                })
                                ->orWhere(function ($query) use ($request_from, $request_to) {
                                    $query
                                        ->whereTime('to', '>=', $request_from)
                                        ->whereTime('to', '<=', $request_to);
                                    // $query
                                    //     ->whereNested(function ($query) use ($request_from, $request_to) {
                                    //         $query
                                    //             ->whereTime('to', '>=', $request_from)
                                    //             ->whereTime('to', '<=', $request_to);
                                    //     });
                                });
                        })
                        ->get();

                    if ($overlapped_time_classrooms->count() != 0) {
                        $fail('يوحد تضارب في يوم وتوقيت الحصة, يرجى اختيار وقت ويوم آخر.');
                    }
                },
            ],
        ];
    }
}
