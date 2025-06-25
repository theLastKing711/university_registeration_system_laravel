<?php

namespace App\Data\Admin\CourseTeacher\UpdateCourseTeacherAttendace\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseTeacherUpdateCourseTeacherAttendaceRequestStudentAttendanceItemData')]
class StudentAttendanceItemData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[
            OAT\Property,
            Required
        ]
        public ?bool $is_student_present,
    ) {}
}
