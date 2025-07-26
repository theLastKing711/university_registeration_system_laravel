<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemester\Response;

use App\Data\Shared\Swagger\Property\DateProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetStudentRegisteredOpenCoursesThisSemesterResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public int $academic_year_semester_id,
        #[DateProperty]
        public string $created_at,
        #[OAT\Property]
        public CourseItemData $course,

    ) {}
}
