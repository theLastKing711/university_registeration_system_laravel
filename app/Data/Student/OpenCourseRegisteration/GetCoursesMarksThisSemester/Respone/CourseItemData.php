<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesMarksThisSemester\Respone;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'GetCoursesMarksCourseItemData')]
class CourseItemData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $code,
        #[OAT\Property]
        public int $credits
    ) {}
}
