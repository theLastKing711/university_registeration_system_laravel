<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesSchedule\Response;

use App\Models\ClassroomCourseTeacher;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetCoursesScheduleResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public int $day,
        #[OAT\Property]
        public string $from,
        #[OAT\Property]
        public string $to,
        #[OAT\Property]
        public CourseItemData $course,
        #[OAT\Property]
        public TeacherItemData $teacher,
        #[OAT\Property]
        public ClassroomItemData $classroom,

    ) {}

    public static function fromModel(ClassroomCourseTeacher $classroom_course_teacher): self
    {

        $course = $classroom_course_teacher->courseTeacher->course->course;

        $teacher = $classroom_course_teacher->courseTeacher->teacher;

        $classroom = $classroom_course_teacher->classroom;

        return new self(
            id: $classroom_course_teacher->id,
            day: $classroom_course_teacher->day,
            from: $classroom_course_teacher->from,
            to: $classroom_course_teacher->to,
            course: new CourseItemData(id: $course->id, name: $course->name),
            teacher: new TeacherItemData(id: $teacher->id, name: $teacher->name),
            classroom: new ClassroomItemData(id: $classroom->id, name: $classroom->name),
        );
    }
}
