<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\CreateExam\Request\CreateExamRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class CreateExamController extends Controller
{
    #[OAT\Post(path: '/admins/exams', tags: ['adminsExams'])]
    #[JsonRequestBody(CreateExamRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateExamRequestData $request)
    {

        $course_teacher =
            CourseTeacher::query()
                ->firstWhere(
                    [
                        'course_id' => $request->course_id,
                        'teacher_id' => $request->teacher_id,
                    ]
                );

        $exam = new Exam;

        $exam->course_teacher_id = $course_teacher->id;
        $exam->classroom_id = $request->classroom_id;
        $exam->max_mark = $request->max_mark;
        $exam->date = $request->date;
        $exam->from = $request->from;
        $exam->to = $request->to;
        $exam->is_main_exam = $request->is_main_exam;

        $exam->save();

    }
}
