<?php

namespace App\Data\Student\OpenCourseRegisteration\GetOpenCoursesThisSemester\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetOpenCoursesThisSemesterResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,
    ) {}
}
