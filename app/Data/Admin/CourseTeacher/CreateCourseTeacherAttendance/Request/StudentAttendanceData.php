<?php

namespace App\Data\Admin\CourseTeacher\CreateCourseTeacherAttendance\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class StudentAttendanceData extends Data
{
    public function __construct(
        #[OAT\Property, Exists('users', 'id')]
        public int $id,
        #[
            OAT\Property,
            Required
        ]
        public bool $is_present,
    ) {}
}
