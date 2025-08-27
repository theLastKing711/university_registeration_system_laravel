<?php

namespace App\Data\Admin\Student\GetStudentsList\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminStudentGetStudentsListRequestGetStudentsListRequestData')]
class GetStudentsListRequestData extends Data
{
    public function __construct(
        // public ?int $department_id,
        // public ?int $academic_year_semester_id,
        public ?int $course_id,
    ) {}

}
