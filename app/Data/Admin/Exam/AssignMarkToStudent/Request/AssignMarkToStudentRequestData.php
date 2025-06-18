<?php

namespace App\Data\Admin\Exam\AssignMarkToStudent\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\Exam;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
class AssignMarkToStudentRequestData extends Data
{
    /**
     * Summary of __construct
     *
     * @param  \Illuminate\Support\Collection<ExamStudentItemData>  $exam_students
     */
    public function __construct(
        #[OAT\Property, Exists('exams', 'id')]
        public int $exam_id,
        #[ArrayProperty(ExamStudentItemData::class)]
        public Collection $exam_students,
    ) {}

    public static function rules(ValidationContext $context): array
    {

        Log::info($context->payload);

        $exam_id = $context->payload['exam_id'];

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
            'exam_students.*.student_id' => Rule::in($exam_course_students_ids),
        ];

    }

    public static function messages(...$args): array
    {

        return [
            'exam_students.*.student_id' => 'الطالب غير مسجل بالمادة, لايمكن تسجيل له علامة فحص.',
        ];
    }
}
