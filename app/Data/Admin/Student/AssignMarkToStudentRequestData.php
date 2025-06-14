<?php

namespace App\Data\Admin\Student;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class AssignMarkToStudentRequestData extends Data
{
    /**
     * Summary of __construct
     *
     * @param  \Illuminate\Support\Collection<ExamStudentItemData>  $exam_students
     */
    public function __construct(
        #[OAT\Property]
        public int $exam_id,
        #[ArrayProperty(ExamStudentItemData::class)]
        public Collection $exam_students,
        #[DateProperty]
        public string $exam_data,
    ) {}
}
