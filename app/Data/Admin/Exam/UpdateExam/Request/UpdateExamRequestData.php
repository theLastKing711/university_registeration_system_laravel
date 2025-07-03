<?php

namespace App\Data\Admin\Exam\UpdateExam\Request;

use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\CourseTeacher;
use App\Models\Exam;
use Closure;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class UpdateExamRequestData extends Data
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

        #[OAT\Property]
        public int $max_mark,
        #[DateProperty]
        public string $date,
        #[
            OAT\Property(default: '08:00:00'),
            DateFormat('H:i:s')
        ]
        public string $from,
        #[
            OAT\Property(default: '10:00:00'),
            DateFormat('H:i:s')
        ]
        public string $to,
        #[OAT\Property]
        public bool $is_main_exam,

        #[
            OAT\PathParameter(
                parameter: 'updateExamIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('exams', 'id')
        ]
        public int $id,

    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'from' => [

                function (string $attribute, mixed $value, Closure $fail) use ($context) {

                    $request_id = $context->payload['id'];

                    $request_classroom_id = $context->payload['classroom_id'];

                    $request_course_teacher_id = $context->payload['course_teacher_id'];

                    $request_date = $context->payload['date'];

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

                    $course_year = $course_teacher->course->academicYearSemester->year;

                    $course_semester = $course_teacher->course->academicYearSemester->semester;

                    $exams_with_overlapped_timing = Exam::query()
                        ->with('courseTeacher.course.course')
                        ->where(
                            'id',
                            '!=',
                            $request_id
                        )
                        ->where('classroom_id', $request_classroom_id)
                        ->where('date', $request_date)
                        ->whereRelation(
                            'courseTeacher.course.academicYearSemester',
                            'year',
                            $course_year
                        )
                        ->whereRelation(
                            'courseTeacher.course.academicYearSemester',
                            'semester',
                            $course_semester
                        )
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
                                });
                        })
                        ->first();

                    if ($exams_with_overlapped_timing != null) {

                        $overlapped_course_name =
                            $exams_with_overlapped_timing->courseTeacher->course->course->name;

                        $fail(
                            __(
                                'messages.exams.overlap',
                                [
                                    'course_name' => $overlapped_course_name,
                                ]
                            )
                        );
                    }
                },
            ],
        ];
    }
}
