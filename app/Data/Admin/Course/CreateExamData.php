<?php

namespace App\Data\Admin\Course;

use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\CourseTeacher;
use App\Models\Exam;
use Closure;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class CreateExamData extends Data
{
    public function __construct(
        #[OAT\Property, Exists('course_teacher', 'id')]
        public int $course_teacher_id,
        #[OAT\Property, Exists('classrooms', 'id')]
        public int $classroom_id,
        #[DateProperty]
        public string $date,
        #[OAT\Property]
        public string $from,
        #[OAT\Property]
        public string $to,
        #[OAT\Property]
        public int $max_mark,
        #[OAT\Property]
        public bool $is_main_exam,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'from' => [

                function (string $attribute, mixed $value, Closure $fail) use ($context) {

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

                    $course_year = $course_teacher->course->year;

                    $course_semester = $course_teacher->course->semester;

                    $exams_with_overlapped_timing = Exam::query()
                        ->where('classroom_id', $request_classroom_id)
                        ->where('date', $request_date)
                        ->whereRelation('courseTeacher.course', 'year', $course_year)
                        ->whereRelation('courseTeacher.course', 'semester', $course_semester)
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
                        ->get();

                    if ($exams_with_overlapped_timing->count() != 0) {
                        $fail('يوحد تضارب في يوم وتوقيت الفحص, يرجى اختيار وقت ويوم آخر.');
                    }
                },
            ],
        ];
    }
}
