<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\AssignMarkToStudent\Request\AssignMarkToStudentRequestData;
use App\Data\Admin\Exam\AssignMarkToStudent\Request\ExamStudentItemData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Exam\Abstract\ExamController;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class AssignMarkToStudentController extends ExamController
{
    #[OAT\Post(path: '/admins/exams/{id}/students', tags: ['adminsExams'])]
    #[JsonRequestBody(AssignMarkToStudentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignMarkToStudentRequestData $request)
    {

        $exam =
            Exam::query()
                ->firstWhere(
                    'id',
                    $request->id
                );

        $exam_attach_data =
            $request
                ->exam_students
                ->mapWithKeys(function (ExamStudentItemData $student) {

                    return [$student->student_id => ['mark' => $student->mark]];

                })
                ->all();

        $exam
            ->students()
            ->attach($exam_attach_data);

    }
}
