<?php

namespace App\Data\Admin\CourseTeacher\GetCourseTeacherStudents\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetCourseTeacherStudentsRespnseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,
    ) {}
}
