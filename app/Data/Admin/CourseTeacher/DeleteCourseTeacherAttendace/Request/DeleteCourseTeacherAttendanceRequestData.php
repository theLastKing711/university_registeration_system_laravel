<?php

namespace App\Data\Admin\CourseTeacher\DeleteCourseTeacherAttendace\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseTeacherDeleteCourseTeacherAttendaceRequestDeleteCourseTeacherAttendanceRequestData')]
class DeleteCourseTeacherAttendanceRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsDeleteCourseTeacherAttendanceIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('course_teacher', 'id')
        ]
        public int $id,

        #[
            OAT\PathParameter(
                parameter: 'adminsDeleteCourseTeacherAttendanceLectureIdPathParameter',
                name: 'lecture_id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('lecture_id'),
            Exists('course_teacher', 'id')
        ]
        public int $lecture_id,
    ) {}
}
