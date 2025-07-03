<?php

namespace App\Data\Admin\Exam\GetExam\Response;

use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\Exam;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetExamResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $course_teacher_id,
        #[OAT\Property]
        public int $classroom_id,
        #[DateProperty]
        public string $max_mark,
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
        #[OAT\Property]
        public ClassroomItemData $classroom,
    ) {}

    public static function fromModel(Exam $exam): self
    {
        return new self(
            $exam->course_teacher_id,
            $exam->classroom_id,
            $exam->max_mark,
            $exam->from,
            $exam->to,
            $exam->is_main_exam,
            new ClassroomItemData(
                $exam->classroom->id,
                $exam->classroom->name
            ),
        );
    }
}
