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
        public int $id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $department_name,
        #[OAT\Property]
        public string $code,
        #[OAT\Property]
        public int $credits,
        #[OAT\Property]
        public int $open_for_students_in_year,
        #[OAT\Property]
        public int $price,
    ) {}
}
