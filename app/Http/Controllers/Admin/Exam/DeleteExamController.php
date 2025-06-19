<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\DeleteExam\Request\DeleteExamRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class DeleteExamController extends ExamController
{
    #[OAT\Delete(path: '/admins/exams/{id}', tags: ['adminsExams'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteExamRequestData $request)
    {
        Exam::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();
    }
}
