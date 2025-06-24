<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'GetCoursesMarkssCourseItemData')]
class CourseItemData extends Data
{
    public function __construct(
        public int $id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $code,
        #[OAT\Property]
        public int $credits,
    ) {}
}
