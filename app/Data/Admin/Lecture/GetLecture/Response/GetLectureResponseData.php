<?php

namespace App\Data\Admin\Lecture\GetLecture\Response;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\Lecture;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminLectureGetLectureResponseGetLectureResponseData')]
class GetLectureResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[DateProperty]
        public string $happened_at,
        #[OAT\Property]
        public int $course_id,
        #[OAT\Property]
        public int $teacher_id,
        #[ArrayProperty(CourseAttendanceData::class)]
        /** @var Collection<CourseAttendanceData> */
        public Collection $course_attendance,
    ) {}

    public static function fromModel(Lecture $lecture): self
    {
        return new self(
            $lecture->id,
            $lecture->happened_at,
            $lecture->courseTeacher->course->id,
            $lecture->courseTeacher->teacher->id,
            CourseAttendanceData::collect($lecture->attendances)
        );
    }
}
