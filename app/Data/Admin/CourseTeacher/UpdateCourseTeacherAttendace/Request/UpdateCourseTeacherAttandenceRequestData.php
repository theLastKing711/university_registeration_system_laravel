<?php

namespace App\Data\Admin\CourseTeacher\UpdateCourseTeacherAttendace\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseTeacherUpdateCourseTeacherAttendaceRequestUpdateCourseTeacherAttendanceRequestData')]
class UpdateCourseTeacherAttandenceRequestData extends Data
{
    public function __construct(

        #[DateProperty]
        public string $happened_at,

        #[ArrayProperty(StudentAttendanceItemData::class)]
        /** @var Collection<StudentAttendanceItemData> */
        public Collection $students_attendandces,

        #[
            OAT\PathParameter(
                parameter: 'adminsUpdateCourseTeacherRequestIdPathParameter',
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
                parameter: 'adminsUpdateCourseTeacherRequestLectureIdPathParameter',
                name: 'lecture_id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('lecture_id'),
            Exists('lectures', 'id')
        ]
        public int $lecture_id,

    ) {}
}
