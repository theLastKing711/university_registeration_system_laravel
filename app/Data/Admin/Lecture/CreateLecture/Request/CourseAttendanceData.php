<?php

namespace App\Data\Admin\Lecture\CreateLecture\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminLectureCreateLectureRequestCourseAttendanceData')]
class CourseAttendanceData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $student_id,
        #[OAT\Property]
        public bool $is_student_present,
    ) {}

}
