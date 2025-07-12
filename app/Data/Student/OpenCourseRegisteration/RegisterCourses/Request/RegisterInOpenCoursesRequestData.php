<?php

namespace App\Data\Student\OpenCourseRegisteration\RegisterCourses\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\Course;
use App\Models\OpenCourseRegisteration;
use App\Models\StudentCourseRegisteration;
use App\Models\User;
use Auth;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
#[MergeValidationRules]
class RegisterInOpenCoursesRequestData extends Data
{
    public function __construct(
        #[ArrayProperty]
        #[Exists('open_course_registerations', 'id')]
        public array $open_courses_ids,
    ) {}

    public static function rules(ValidationContext $context)
    {

        /** @var array $request_open_courses_ids */
        $request_open_courses_ids =
            $context
                ->payload['open_courses_ids'];

        $open_courses =
            OpenCourseRegisteration::query()
                ->with(relations: 'course.coursesPrerequisites')
                ->whereIdIn($request_open_courses_ids)
                ->get();

        $logged_student =
            User::query()
                ->firstWhere(
                    'id',
                    Auth::User()->id
                );

        $unique_courses_prerequisites_ids =
           $open_courses
               ->pluck('course.coursesPrerequisites')
               ->flatten(1)
               ->pluck('id')
               ->unique();

        Log::info(
            $unique_courses_prerequisites_ids
                ->toArray()
        );

        $student_passed_courses_for_prerequisites = StudentCourseRegisteration::query()
            ->with([
                'course.course',
                'student',
            ])
            ->where(column: 'student_id', operator: $logged_student->id)
            ->where('final_mark', '>=', 60)
            ->whereHas(
                'course.course',
                fn ($query) => $query
                    ->whereIn('id', $unique_courses_prerequisites_ids)
            )
            ->get()
            ->pluck('course.course.id')
            ->unique();

        $unfinished_required_prerequisites_ids =
            $unique_courses_prerequisites_ids
                ->diff(items: $student_passed_courses_for_prerequisites);

        $unfinished_required_prerequisites =
            Course::query()
                ->whereIn(
                    'id',
                    $unique_courses_prerequisites_ids
                )
                ->get();

        Log::info($student_passed_courses_for_prerequisites);

        $user_has_required_unfinished_prerequisites =
            $unfinished_required_prerequisites_ids
                ->isNotEmpty();

        /** @var Collection<OpenCourseRegisteration> $duplicated_registered_open_courses description */
        $duplicated_registered_open_courses =
            StudentCourseRegisteration::query()
                ->with('course.course')
                ->where(
                    'student_id',
                    $logged_student->id
                )
                ->whereIn(
                    'course_id',
                    $request_open_courses_ids
                )
                ->get()
                ->pluck('course');

        return [
            'open_courses_ids.*' => [function (string $attribute, mixed $value, Closure $fail) use ($open_courses, $unfinished_required_prerequisites, $duplicated_registered_open_courses) {

                /** @var array $request_open_course_id */
                $request_open_course_id = $value;

                $student_has_already_registered_in_open_course =
                    $duplicated_registered_open_courses
                        ->pluck('id')
                        ->contains(
                            $request_open_course_id
                        );

                if ($student_has_already_registered_in_open_course) {
                    $fail(
                        __(
                            'messages.open_coruse_registeraions.duplicate_registered_course',
                            [
                                'course_code' => $duplicated_registered_open_courses
                                    ->firstWhere('id', $request_open_course_id)
                                    ->course
                                    ->code,
                            ]
                        )
                    );
                }

                /** @var OpenCourseRegisteration $open_course */
                $open_course =
                    $open_courses
                        ->where(
                            'id',
                            $request_open_course_id
                        )
                        ->first();
                Log::info($unfinished_required_prerequisites);

                $unfinished_required_prerequisites_for_this_open_course =
                $open_course
                    ->course
                    ->coursesPrerequisites
                    ->intersect(
                        $unfinished_required_prerequisites
                    );

                if ($unfinished_required_prerequisites_for_this_open_course->isNotEmpty()) {
                    $fail(
                        __(
                            'messages.open_coruse_registeraions.unfinished_required_prerequisites',
                            [
                                'courses_codes' => $unfinished_required_prerequisites_for_this_open_course
                                    ->pluck('code')
                                    ->implode(','),
                            ]
                        )
                    );
                }

            }],
        ];

    }
}
