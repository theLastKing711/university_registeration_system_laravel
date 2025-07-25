<?php

namespace App\Data\Admin\OpenCourseRegisteration\AssignTeacherToCourse\Request;

use App\Models\OpenCourseRegisteration;
use Closure;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Bail;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
#[MergeValidationRules]
class AssignTeacherToCourseRequestData extends Data
{
    public function __construct(

        #[
            OAT\Property,
            Bail,
            Exists('teachers', 'id'),
        ]
        public int $teacher_id,

        #[OAT\Property]
        public bool $is_main_teacher,

        #[
            OAT\PathParameter(
                parameter: 'adminsOpenCourseRegisterationAssignTeachToCouresIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Bail,
            Exists('open_course_registerations', 'id'),
        ]
        public int $id,
    ) {}

    public static function stopOnFirstFailure(): bool
    {
        return true;
    }

    public static function rules(ValidationContext $context): array
    {

        return [

            'teacher_id' => [

                function (string $attribute, mixed $value, Closure $fail) use ($context) {

                    $request_is_main_teacher =
                        $context->payload['is_main_teacher'];

                    $request_course_id =
                        $context->payload['id'];

                    $open_course = OpenCourseRegisteration::query()
                        ->with('teachers')
                        ->firstWhere(
                            'id',
                            $request_course_id
                        );

                    $course_main_teacher =
                        $open_course
                            ->teachers()
                            ->wherePivot('is_main_teacher', true)
                            ->first();

                    $course_has_main_teacher =
                        $course_main_teacher != null;

                    if ($course_has_main_teacher && $request_is_main_teacher) {
                        $fail(
                            __('messages.course_teacher.only_one_main_teacher_per_open_course')
                        );
                    }
                },
            ],
        ];
    }
}
