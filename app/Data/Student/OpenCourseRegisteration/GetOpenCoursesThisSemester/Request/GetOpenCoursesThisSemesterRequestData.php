<?php

namespace App\Data\Student\OpenCourseRegisteration\GetOpenCoursesThisSemester\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetOpenCoursesThisSemesterRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?string $query,
    ) {}
}
