<?php

namespace App\Data\Student\Course;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\Course;
use App\Models\Prerequisite;
use App\Models\StudentCourseRegisteration;
use App\Models\User;
use Closure;
use Log;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
#[MergeValidationRules]
class RegisterCoursesRequestData extends Data
{
    public function __construct(
        #[ArrayProperty]
        #[Exists('open_course_registerations', 'id')]
        public array $course_ids,
    ) {}

    public static function rules(ValidationContext $context)
    {

        // Log::info($context->payload);

        // Log::info($student_passed_courses_for_prerequisites);

        return [
            'course_ids' => function (string $attribute, mixed $value, Closure $fail) {
                /** @var array $course_ids */
                $course_ids = $value;
                // $course_ids = $context->payload['course_ids'];

                // Log::info($attribute);

                $student =
                    User::query()
                        ->firstWhere(
                            'id',
                            operator: 1
                        );

                $unique_courses_prerequisites_ids =
                    Prerequisite::query()
                        ->whereIn(
                            'course_id',
                            $course_ids
                        )
                        ->pluck('prerequisite_id')
                        ->unique()
                        ->collect();

                Log::info($unique_courses_prerequisites_ids);

                $student_passed_courses_for_prerequisites = StudentCourseRegisteration::query()
                    ->with([
                        'course.course',
                        'student',
                    ])
                    ->where('final_mark', '>=', 60)
                    ->whereHas(
                        'course.course',
                        fn ($query) => $query->whereIn('id', $unique_courses_prerequisites_ids)
                    )
                    ->where('student_id', $student->id)
                    ->get()
                    // ->unique('course.course.id')
                    ->pluck('course.course.id')
                    ->unique();

                $unfinished_prerequisites_ids =
                    $unique_courses_prerequisites_ids
                        ->diff(items: $student_passed_courses_for_prerequisites);

                $user_has_required_unfinished_prerequisites =
                    $unfinished_prerequisites_ids
                        ->count() > 0;

                if ($user_has_required_unfinished_prerequisites) {
                    $unfinished_prerequisites_names =
                        Course::query()
                            ->whereIn('id', $unfinished_prerequisites_ids)
                            ->pluck('code')
                            ->reduce(
                                fn ($prev, $current) => $prev.', '.$current,
                                ''
                            );

                    $fail($unfinished_prerequisites_names.' يجب إنهاء المتطلبات السابقة التالية');
                }
            },
        ];
    }
}
