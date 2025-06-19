<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\UpdateExam\Request\UpdateExamRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Models\Exam;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;

class UpdateExamController extends ExamController
{
    #[OAT\Patch(path: '/admins/exams/{id}', tags: ['adminsExams'])]
    #[JsonRequestBody(UpdateExamRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateExamRequestData $request)
    {

        Log::info($request->all());

        Exam::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update(
                $request->all()
            );
    }
}
