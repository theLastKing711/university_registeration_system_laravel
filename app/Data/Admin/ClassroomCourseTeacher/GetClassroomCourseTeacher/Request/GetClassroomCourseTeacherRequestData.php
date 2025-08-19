<?php

namespace App\Data\Admin\ClassroomCourseTeacher\GetClassroomCourseTeacher\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminClassroomCourseTeacherGetClassroomCourseTeacherRequestGetClassroomCourseTeacherRequestData')]
class GetClassroomCourseTeacherRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'AdminClassroomCourseTeacherGetClassroomCourseTeacherRequestGetClassroomCourseTeacherRequestData',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('classroom_course_teacher', 'id')
        ]
        public int $id,
    ) {}

}
