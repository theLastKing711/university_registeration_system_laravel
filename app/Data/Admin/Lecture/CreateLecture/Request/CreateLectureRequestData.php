<?php

namespace App\Data\Admin\Lecture\CreateLecture\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminLectureCreateLectureRequestCreateLectureRequestData')]
class CreateLectureRequestData extends Data
{
    public function __construct(
        #[DateProperty]
        public Carbon $happened_at,
        #[OAT\Property]
        public int $course_id,
        #[OAT\Property]
        public int $teacher_id,
        #[ArrayProperty(CourseAttendanceData::class)]
        /** @var Collection<CourseAttendanceData> */
        public Collection $course_attendance,
    ) {}

}
