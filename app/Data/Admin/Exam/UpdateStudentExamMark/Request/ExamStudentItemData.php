<?php

namespace App\Data\Admin\Exam\UpdateStudentExamMark\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'adminsExamUpdateExamStudentExamMarkRequestExamStudentItemData')]
class ExamStudentItemData extends Data
{
    public function __construct(
        #[
            OAT\Property,
            Exists('exam_students', 'id')
        ]
        public int $id,

        #[OAT\Property, Exists('users', 'id')]
        public int $student_id,
        #[OAT\Property]
        public int $mark,
    ) {}
}
