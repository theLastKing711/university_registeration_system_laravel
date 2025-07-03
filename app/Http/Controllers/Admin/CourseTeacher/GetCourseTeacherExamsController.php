<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\GetCourseTeacherExams\Request\GetCourseTeacherExamsRequestData;
use App\Data\Admin\CourseTeacher\GetCourseTeacherExams\Response\GetCourseTeacherExamsResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Admin\CourseTeacher\Abstract\CourseTeacherController;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class GetCourseTeacherExamsController extends CourseTeacherController
{
    #[OAT\Get(path: '/admins/course-teachers/{id}/exams', tags: ['adminsCourseTeachers'])]
    #[SuccessListResponse(GetCourseTeacherExamsResponseData::class)]
    public function __invoke(GetCourseTeacherExamsRequestData $request)
    {
        $teacher_exams =
           Exam::query()
               ->with(
                   [
                       'classroom',
                       'courseTeacher' => [
                           'teacher',
                       ],
                   ]
               )
               ->where(
                   'course_teacher_id',
                   $request
                       ->id
               )
               ->get();

        return GetCourseTeacherExamsResponseData::collect($teacher_exams);
    }
}
