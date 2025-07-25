<?php

namespace App\Data\Admin\Exam\AssignMarkToStudent\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\Exam;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
#[MergeValidationRules]
class AssignMarkToStudentRequestData extends Data
{
    /**
     * Summary of __construct
     *
     * @param  \Illuminate\Support\Collection<ExamStudentItemData>  $exam_students
     */
    public function __construct(

        #[
            ArrayProperty(ExamStudentItemData::class),
        ]
        public Collection $exam_students,

        #[
            OAT\PathParameter(
                parameter: 'adminsExamASsignMarkToStudentIdPathParameter',
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

        $exam_id = $context->payload['id'];

        $exam_course_students_ids = Exam::query()
            ->with(relations: 'courseTeacher.course.students')
            ->firstWhere(
                'id',
                $exam_id
            )
            ->courseTeacher
            ->course
            ->students
            ->pluck('id');

        Log::info($exam_course_students_ids);

        return [
            'exam_students.*.student_id' => [
                function (string $attribute, mixed $value, Closure $fail) use ($exam_course_students_ids) {

                    $student_has_registered_in_exam_course =
                        $exam_course_students_ids
                            ->contains($value);

                    if (! $student_has_registered_in_exam_course) {
                        $fail($attribute,
                            __(
                                'messages.exam_students.student unregistered in course',
                                [
                                    'id' => $value,
                                ]
                            )
                        );
                    }

                },
            ],
        ];

    }
}
