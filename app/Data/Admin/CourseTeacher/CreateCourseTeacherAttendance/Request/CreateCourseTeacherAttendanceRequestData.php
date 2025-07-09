<?php

namespace App\Data\Admin\CourseTeacher\CreateCourseTeacherAttendance\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class CreateCourseTeacherAttendanceRequestData extends Data
{
    /**
     * @param  Collection<StudentAttendanceData>  $students_attendance
     */
    public function __construct(

        #[DateProperty]
        public string $happened_at,

        #[ArrayProperty(StudentAttendanceData::class)]
        public Collection $students_attendance,

        #[
            OAT\PathParameter(
                parameter: 'adminsCourseTeacherIdPathParameter',
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
