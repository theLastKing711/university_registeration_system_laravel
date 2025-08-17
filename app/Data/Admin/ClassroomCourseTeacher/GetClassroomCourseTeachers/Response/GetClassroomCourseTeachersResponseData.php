<?php

namespace App\Data\Admin\ClassroomCourseTeacher\GetClassroomCourseTeachers\Response;

use App\Models\ClassroomCourseTeacher;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminClassroomCourseTeacherGetClassroomCourseTeachersResponseGetClassroomCourseTeachersResponseData')]
class GetClassroomCourseTeachersResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public int $classroom_id,
        #[OAT\Property]
        public int $course_id,
        #[OAT\Property]
        public string $course_name,
        #[OAT\Property]
        public int $teacher_id,
        #[OAT\Property]
        public string $teacher_name,
        #[OAT\Property]
        public int $day,
        #[OAT\Property]
        public string $from,
        #[OAT\Property]
        public string $to,
    ) {}

    public static function fromModel(ClassroomCourseTeacher $classroom_course_teacher): self
    {
        return new self(
            $classroom_course_teacher->id,
            $classroom_course_teacher->classroom_id,
            $classroom_course_teacher->courseTeacher->course_id,
            $classroom_course_teacher->courseTeacher->course->course->name,
            $classroom_course_teacher->courseTeacher->teacher_id,
            $classroom_course_teacher->courseTeacher->teacher->name,
            $classroom_course_teacher->day,
            $classroom_course_teacher->from,
            $classroom_course_teacher->to
        );
    }
}
