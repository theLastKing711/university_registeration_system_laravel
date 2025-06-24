<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesMarksThisSemester\Respone;

use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\StudentCourseRegisteration;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetCoursesMarksThisSemesterResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public CourseItemData $course,
        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,
        #[OAT\Property]
        public int $final_mark,
        // #[DateProperty]
        // public string $date_applied = now()
        #[OAT\Property]
        public int $exam_mark = 100,
    ) {}

    public static function fromModel(StudentCourseRegisteration $student_course_registeration): self
    {

        $course = $student_course_registeration->course->course;

        return new self(
            id: $student_course_registeration->id,
            course: CourseItemData::from($course),
            year: $student_course_registeration->course->year,
            semester: $student_course_registeration->course->semester,
            final_mark: $student_course_registeration->final_mark,
            // date_applied: $student_course_registeration->created_at,
        );
    }
}
