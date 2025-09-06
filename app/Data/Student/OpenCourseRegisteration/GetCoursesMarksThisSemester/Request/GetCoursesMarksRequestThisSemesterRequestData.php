<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesMarksThisSemester\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetCoursesMarksRequestThisSemesterRequestData extends Data
{
    public function __construct(
        public ?string $query,
    ) {}
}
