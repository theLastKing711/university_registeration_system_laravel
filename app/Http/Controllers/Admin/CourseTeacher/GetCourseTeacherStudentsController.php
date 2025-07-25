<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\GetCourseTeacherStudents\Response\GetCourseTeacherStudentsRespnseData;
use App\Data\Admin\CourseTeacher\PathParameters\CourseTeacherPathParameterData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Admin\CourseTeacher\Abstract\CourseTeacherController;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class GetCourseTeacherStudentsController extends CourseTeacherController
{
    #[OAT\Get(path: '/admins/course-teachers/{id}/students', tags: ['adminsCourseTeachers'])]
    #[SuccessListResponse(GetCourseTeacherStudentsRespnseData::class)]
    public function __invoke(CourseTeacherPathParameterData $request)
    {

        $course_teacher_students =
            CourseTeacher::query()
                ->with('course.students:id,name')
                ->firstWhere(
                    'id',
                    $request->id,
                )
                ->course
                ->students
                ->select('id', 'name');

        return
            GetCourseTeacherStudentsRespnseData::collect(
                $course_teacher_students
            );

    }
}
