<?php

namespace App\Data\Admin\CourseTeacher\GetCourseTeacherExams\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseTeacherGetCourseTeacherExamsRequestGetCourseTeacherExamsRequestData')]
class GetCourseTeacherExamsRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsCourseTeacherGetCourseTeacherExamsIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('course_teacher', 'id')
        ]
        public int $id,
    ) {}
}
