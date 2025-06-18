<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\CreateCourseTeacherExam\Request\CreateCourseTeacherExamRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class CreateCourseTeacherExamController extends Controller
{
    #[OAT\Post(path: '/admins/course-teachers/exams', tags: ['adminsCourseTeachers'])]
    #[JsonRequestBody(CreateCourseTeacherExamRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateCourseTeacherExamRequestData $request)
    {

        CourseTeacher::query()
            ->firstWhere(
                'id',
                $request->course_teacher_id
            )
            ->examClassrooms()
            ->attach(
                [$request->classroom_id],
                [
                    'from' => $request->from,
                    'to' => $request->to,
                    'date' => $request->date,
                    'max_mark' => $request->max_mark,
                    'is_main_exam' => $request->is_main_exam,
                ]
            );

    }
}
