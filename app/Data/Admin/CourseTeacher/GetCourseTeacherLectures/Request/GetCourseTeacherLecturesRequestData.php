<?php

namespace App\Data\Admin\CourseTeacher\GetCourseTeacherLectures\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseTeacherGetCourseTeacherLecturesRequestGetCourseTeacherLecturesRequestData')]
class GetCourseTeacherLecturesRequestData extends Data
{
    public function __construct(

        #[
            OAT\PathParameter(
                parameter: 'adminsCourseTeachersGetCourseTeachersLecturesIdPathParameter',
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
