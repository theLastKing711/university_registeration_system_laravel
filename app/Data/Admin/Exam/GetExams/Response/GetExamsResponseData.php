<?php

namespace App\Data\Admin\Exam\GetExams\Response;

use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\Exam;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminExamGetExamsResponseGetExamsResponseData')]
class GetExamsResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $course_name,
        #[OAT\Property]
        public string $teacher_name,
        #[OAT\Property]
        public int $course_teacher_id,
        #[OAT\Property]
        public int $classroom_id,
        #[OAT\Property]
        public string $classroom_name,
        #[OAT\Property]
        public string $max_mark,
        #[DateProperty]
        public ?string $date,
        #[
            OAT\Property(default: '08:00:00'),
        ]
        public string $from,
        #[
            OAT\Property(default: '08:00:00'),
        ]
        public string $to,
        #[OAT\Property]
        public bool $is_main_exam,
    ) {}

    public static function fromModel(Exam $exam): self
    {
        return new self(
            $exam->id,
            $exam->courseTeacher->course->course->name,
            $exam->courseTeacher->teacher->name,
            $exam->course_teacher_id,
            $exam->classroom_id,
            $exam->classroom->name,
            $exam->max_mark,
            $exam->date,
            $exam->from,
            $exam->to,
            $exam->is_main_exam
        );
    }
}
