<?php

namespace App\Data\Admin\Student;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class ExamStudentItemData extends Data
{
    public function __construct(
        #[OAT\Property, Exists('users', 'id')]
        public int $student_id,
        #[OAT\Property]
        public int $mark,
    ) {}
}
