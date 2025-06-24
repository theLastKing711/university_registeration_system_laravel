<?php

namespace App\Data\Admin\ClassroomCourseTeacher\DeleteClassroomCourseTeacherClassroom\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class DeleteClassroomCourseTeacherRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'deleteClassroomCourseTeacherPathParameter',
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
