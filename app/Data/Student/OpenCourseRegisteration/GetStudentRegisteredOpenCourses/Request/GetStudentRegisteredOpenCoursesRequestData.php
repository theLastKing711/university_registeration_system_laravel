<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCourses\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema()]
class GetStudentRegisteredOpenCoursesRequestData extends Data
{
    public function __construct(

    ) {}

}
