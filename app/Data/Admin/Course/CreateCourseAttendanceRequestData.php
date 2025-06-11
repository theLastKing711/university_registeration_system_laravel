<?php

namespace App\Data\Admin\Course;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class CreateCourseAttendanceRequestData extends Data
{
    /**
     * @param  Collection<StudentAttendanceData>  $students_attendance
     */
    public function __construct(
        #[OAT\Property, Exists('course_teacher', 'id')]
        public int $course_teacher_id,

        #[DateProperty]
        public string $date,

        #[ArrayProperty(StudentAttendanceData::class)]
        public Collection $students_attendance,
    ) {}
}
