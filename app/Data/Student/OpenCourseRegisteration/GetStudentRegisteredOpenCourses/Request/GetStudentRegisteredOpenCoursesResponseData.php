<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCourses\Response;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema()]
class GetStudentRegisteredOpenCoursesResponseData extends Data
{
    public function __construct(

    ) {
    }
}
