<?php

namespace App\Data\Admin\Exam\UpdateStudentExamMark\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminExamUpdateStudentExamMarkResponseUpdateStudentExamMarkResponseData')]
class UpdateStudentExamMarkResponseData extends Data
{
    public function __construct(

    ) {}

}
