<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\Course\GetCourseExamsData;
use App\Data\Admin\CourseTeacher\GetCourseTeacherExams\Request\GetCourseTeacherExamsRequestData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/course-teachers/{id}/exams',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/getCourseTeacherExamsDataPathParameter'
            ),
        ]
    )
]
class GetCourseTeacherExamsController extends Controller
{
    #[OAT\Get(path: '/admins/course-teachers/{id}/exams', tags: ['adminsCourseTeachers'])]
    #[SuccessListResponse(GetCourseExamsData::class)]
    public function __invoke(GetCourseTeacherExamsRequestData $request)
    {

        $course_exams =
            Exam::query()
                ->where(
                    'course_teacher_id',
                    $request->id
                )
                ->get();

        return $course_exams;
    }
}
