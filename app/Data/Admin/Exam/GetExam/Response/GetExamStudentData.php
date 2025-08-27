<?php

namespace App\Data\Admin\Exam\GetExam\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetExamStudentData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public ?int $student_id,
        #[OAT\Property]
        public ?int $exam_id,
        #[OAT\Property]
        public ?int $mark,
    ) {}

}
