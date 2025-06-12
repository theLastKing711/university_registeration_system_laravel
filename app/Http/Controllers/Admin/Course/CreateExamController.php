<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\CreateExamData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class CreateExamController extends Controller
{
    #[OAT\Post(path: '/admins/courses/createExam', tags: ['adminsCourses'])]
    #[JsonRequestBody(CreateExamData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateExamData $request)
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
