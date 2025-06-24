<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesScheduleThisSemester\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetCoursesScheduleThisSemesterRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,
    ) {}
}
