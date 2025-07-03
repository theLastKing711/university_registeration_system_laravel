<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\UpdateExam\Request\UpdateExamRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Exam\Abstract\ExamController;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class UpdateExamController extends ExamController
{
    #[OAT\Patch(path: '/admins/exams/{id}', tags: ['adminsExams'])]
    #[JsonRequestBody(UpdateExamRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateExamRequestData $request)
    {
        Exam::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update(
                [
                    'classroom_id' => $request->classroom_id,
                    'course_teacher_id' => $request->course_teacher_id,
                    'from' => $request->from,
                    'date' => $request->date,
                    'to' => $request->to,
                    'is_main_exam' => $request->is_main_exam,
                    'max_mark' => $request->max_mark,
                ]
            );
    }
}
