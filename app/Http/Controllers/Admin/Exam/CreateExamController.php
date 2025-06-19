<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\CreateExam\Request\CreateExamRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class CreateExamController extends Controller
{
    #[OAT\Post(path: '/admins/exams', tags: ['adminsExams'])]
    #[JsonRequestBody(CreateExamRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateExamRequestData $request)
    {

        $exam = new Exam;

        $exam->course_teacher_id = $request->course_teacher_id;
        $exam->classroom_id = $request->classroom_id;
        $exam->max_mark = $request->max_mark;
        $exam->date = $request->date;
        $exam->from = $request->from;
        $exam->to = $request->to;
        $exam->is_main_exam = $request->is_main_exam;

        $exam->save();

    }
}
