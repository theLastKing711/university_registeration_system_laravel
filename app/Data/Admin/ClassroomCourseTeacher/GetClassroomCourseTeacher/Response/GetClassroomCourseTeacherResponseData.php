<?php

namespace App\Data\Admin\ClassroomCourseTeacher\GetClassroomCourseTeacher\Response;

use App\Models\ClassroomCourseTeacher;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminClassroomCourseTeacherGetClassroomCourseTeacherResponseGetClassroomCourseTeacherResponseData')]
class GetClassroomCourseTeacherResponseData extends Data
{
    public function __construct(
        #[
            OAT\Property,
        ]
        public int $classroom_id,

        #[
            OAT\Property,
        ]
        public int $course_id,

        #[
            OAT\Property,

        ]
        public int $teacher_id,

        #[OAT\Property]
        public int $day,

        #[
            OAT\Property(default: '08:00:00'),

        ]
        public string $from,

        #[
            OAT\Property(default: '08:00:00'),
        ]
        public string $to,
    ) {}

    public static function fromModel(ClassroomCourseTeacher $classroom_course_teacher): self
    {
        return new self(
            $classroom_course_teacher->id,
            $classroom_course_teacher->courseTeacher->course_id,
            $classroom_course_teacher->courseTeacher->teacher_id,
            $classroom_course_teacher->day,
            $classroom_course_teacher->from,
            $classroom_course_teacher->to,
        );
    }
}
