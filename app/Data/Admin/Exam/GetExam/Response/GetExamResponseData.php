<?php

namespace App\Data\Admin\Exam\GetExam\Response;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\Exam;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetExamResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[
            OAT\Property,
        ]
        public int $course_id,
        #[
            OAT\Property,
        ]
        public int $teacher_id,
        #[
            OAT\Property,
        ]
        public int $classroom_id,
        #[OAT\Property]
        public int $max_mark,
        #[
            DateProperty,
        ]
        public string $date,
        #[
            OAT\Property(default: '08:00:00'),
        ]
        public string $from,
        #[
            OAT\Property(default: '10:00:00'),
        ]
        public string $to,
        #[OAT\Property]
        public bool $is_main_exam,

        #[ArrayProperty(GetExamStudentData::class)]
        /** @var Collection<GetExamStudentData> */
        public Collection $exam_students,
    ) {}

    public static function fromModel(Exam $exam): self
    {
        return new self(
            $exam->id,
            $exam->courseTeacher->course->id,
            $exam->courseTeacher->teacher->id,
            $exam->classroom_id,
            $exam->max_mark,
            $exam->date,
            $exam->from,
            $exam->to,
            $exam->is_main_exam,
            GetExamStudentData::collect($exam->examStudents)
        );
    }
}
