<?php

namespace App\Data\Student\OpenCourseRegisteration\RegisterCourses\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\User;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
#[MergeValidationRules]
class RegisterOpenCoursesRequestData extends Data
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

        return
        $logged_student =
             User::query()
                 ->with([
                     'department' => [
                         'openRegisterations' => fn ($query) => $query
                             ->select([
                                 'id',
                                 'department_id',
                                 'semester',
                                 'year',
                             ])
                             ->where(
                                 'is_open_for_students',
                                 true
                             )
                             ->orderBy('year', 'desc')
                             ->orderBy('semester', 'desc')
                             ->take(1),
                         // ->take(1),
                         // for some reasion duplication query
                     ],
                 ])
                 ->firstWhere(
                     column: 'id',
                     operator: 1
                 );

        // return [
        //     'course_ids.*' => Rule::in(1, 2, 4),
        //     'course_ids' => [function (string $attribute, mixed $value, Closure $fail) {

        //         /** @var array $course_ids */
        //         $course_ids = $value;

        //         $student =
        //             User::query()
        //                 ->firstWhere(
        //                     'id',
        //                     operator: 1
        //                 );

        //         $unique_courses_prerequisites_ids =
        //             Prerequisite::query()
        //                 ->whereIn(
        //                     'course_id',
        //                     $course_ids
        //                 )
        //                 ->pluck('prerequisite_id')
        //                 ->unique()
        //                 ->collect();

        //         Log::info($unique_courses_prerequisites_ids);

        //         $student_passed_courses_for_prerequisites = StudentCourseRegisteration::query()
        //             ->with([
        //                 'course.course',
        //                 'student',
        //             ])
        //             ->where('final_mark', '>=', 60)
        //             ->whereHas(
        //                 'course.course',
        //                 fn ($query) => $query->whereIn('id', $unique_courses_prerequisites_ids)
        //             )
        //             ->where('student_id', $student->id)
        //             ->get()
        //             // ->unique('course.course.id')
        //             ->pluck('course.course.id')
        //             ->unique();

        //         $unfinished_required_prerequisites_ids =
        //             $unique_courses_prerequisites_ids
        //                 ->diff(items: $student_passed_courses_for_prerequisites);

        //         $user_has_required_unfinished_prerequisites =
        //             $unfinished_required_prerequisites_ids
        //                 ->isNotEmpty();

        //         if ($user_has_required_unfinished_prerequisites) {
        //             $unfinished_prerequisites_names =
        //                 Course::query()
        //                     ->whereIn('id', $unfinished_required_prerequisites_ids)
        //                     ->pluck('code')
        //                     ->reduce(
        //                         fn ($prev, $current) => $prev.', '.$current,
        //                         ''
        //                     );

        //             Log::info($unfinished_required_prerequisites_ids);

        //             $unfinished_required_prerequisites_ids->each(function ($unfinished_prerequisite, $index) use ($fail, $unfinished_prerequisites_names) {

        //                 $fail("courses_ids.{$index}", $unfinished_prerequisites_names.' يجب إنهاء المتطلبات السابقة التالية');

        //             });

        //             $fail($unfinished_prerequisites_names.' يجب إنهاء المتطلبات السابقة التالية');

        //         }
        //     }],
        // ];
    }
}
