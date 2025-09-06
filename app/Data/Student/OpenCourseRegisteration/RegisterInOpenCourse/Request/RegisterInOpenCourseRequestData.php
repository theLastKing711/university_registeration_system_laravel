<?php

namespace App\Data\Student\OpenCourseRegisteration\RegisterInOpenCourse\Request;

use App\Models\OpenCourseRegisteration;
use App\Models\StudentCourseRegisteration;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'StudentOpenCourseRegisterationRegisterInOpenCourseRequestRegisterInOpenCourseRequestData')]
class RegisterInOpenCourseRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'StudentOpenCourseRegisterationRegisterInOpenCourseRequestRegisterInOpenCourseRequestDataIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists(OpenCourseRegisteration::class, 'id')
        ]
        public int $id,
    ) {}

    public static function rules(ValidationContext $context): array
    {

        return [
            'id' => [function (string $attribute, mixed $value, Closure $fail) {

                /** @var array $request_open_course_id */
                $request_open_course_id = $value;

                $open_course =
                    OpenCourseRegisteration::query()
                        ->with(relations: 'course.coursesPrerequisites')
                        ->firstWhere('id', $request_open_course_id);

                $logged_student =
                    User::query()
                        ->firstWhere(
                            'id',
                            Auth::User()->id
                        );

                $course_prerequisites =
                    $open_course
                        ->course
                        ->coursesPrerequisites;

                $courses_prerequisites_ids =
                    $course_prerequisites
                        ->pluck('id')
                        ->unique();

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
                            ->whereIn('id', $courses_prerequisites_ids)
                    )
                    ->get()
                    ->pluck('course.course.id')
                    ->unique();

                $unfinished_required_prerequisites_ids =
                    $courses_prerequisites_ids
                        ->diff(items: $student_passed_courses_for_prerequisites);

                $student_has_already_registered_in_open_course =
                    StudentCourseRegisteration::query()
                        ->where(
                            [
                                'course_id' => $request_open_course_id,
                                'student_id' => $logged_student->id,
                            ]
                        )
                        ->first();

                if ($student_has_already_registered_in_open_course) {
                    $fail(
                        __(
                            'messages.open_coruse_registeraions.duplicate_registered_course',
                            [
                                'course_code' => $open_course
                                    ->course
                                    ->code,
                            ]
                        )
                    );
                }

                if ($unfinished_required_prerequisites_ids->isNotEmpty()) {
                    $fail(
                        __(
                            'messages.open_coruse_registeraions.unfinished_required_prerequisites',
                            [
                                'courses_codes' => $course_prerequisites
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
