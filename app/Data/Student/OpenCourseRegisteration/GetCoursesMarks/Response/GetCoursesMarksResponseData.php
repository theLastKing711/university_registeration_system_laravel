<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Response;

use App\Models\StudentCourseRegisteration;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetCoursesMarksResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public CourseItemData $course,
        #[OAT\Property]
        public int $academic_year_semester_id,
        #[OAT\Property]
        public int $final_mark,

        #[OAT\Property]
        public int $exam_mark = 100,
    ) {}

    public static function fromModel(StudentCourseRegisteration $student_course_registeration): self
    {

        $course = $student_course_registeration->course->course;

        return new self(
            id: $student_course_registeration->id,
            course: CourseItemData::from($course),
            academic_year_semester_id: $student_course_registeration->course->academic_year_semester_id,
            final_mark: $student_course_registeration->final_mark,
            // date_applied: $student_course_registeration->created_at,
        );
    }
}
