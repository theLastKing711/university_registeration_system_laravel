<?php

namespace App\Data\Admin\OpenCourseRegisteration\CreateOpenCourseRegisteration\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\OpenCourseRegisteration;
use Closure;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[MergeValidationRules]
#[Oat\Schema(schema: 'AdminOpenCourseRegisterationCreateOpenCourseRegisterationRequestCreateOpenCourseRegisterationRequestData')]
class CreateOpenCourseRegisterationRequestData extends Data
{
    public function __construct(
        #[
            OAT\Property,
            Exists('courses', 'id')
        ]
        public int $course_id,
        #[OAT\Property]
        public int $academic_year_semester_id,
        #[OAT\Property]
        public int $price_in_usd,

        #[ArrayProperty(CreateTeacherData::class)]
        /** @var Collection<CreateTeacherData> */
        public Collection $teachers,

    ) {}

    public static function rules(ValidationContext $context): array
    {

        $request_course_id =
            $context->payload['course_id'];

        $request_academic_year_semester_id =
            $context->payload['academic_year_semester_id'];

        $duplicate_open_course =
            OpenCourseRegisteration::query()
                ->firstWhere(
                    [
                        'course_id' => $request_course_id,
                        'academic_year_semester_id' => $request_academic_year_semester_id,
                    ]
                );

        return [
            'course_id' => [function (string $attribute, mixed $value, Closure $fail) use ($duplicate_open_course) {

                if ($duplicate_open_course) {
                    $fail(
                        __(
                            'messages.admin.open_coruse_registeraions.course_opened_previously',
                        )
                    );
                }

            }],
        ];
    }
}
