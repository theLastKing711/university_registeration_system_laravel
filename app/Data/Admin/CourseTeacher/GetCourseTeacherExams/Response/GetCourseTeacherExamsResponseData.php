<?php

namespace App\Data\Admin\CourseTeacher\GetCourseTeacherExams\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseTeacherGetCourseTeacherExamsResponseGetCourseTeacherExamsResponseData')]
class GetCourseTeacherExamsResponseData extends Data
{
    public function __construct(

    ) {}

}
