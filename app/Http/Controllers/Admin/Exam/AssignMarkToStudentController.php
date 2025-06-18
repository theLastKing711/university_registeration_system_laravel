<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\AssignMarkToStudent\Request\AssignMarkToStudentRequestData;
use App\Data\Admin\Exam\AssignMarkToStudent\Request\ExamStudentItemData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class AssignMarkToStudentController extends Controller
{
    #[OAT\Post(path: '/admins/students/exam-marks', tags: ['adminsStudents'])]
    #[JsonRequestBody(AssignMarkToStudentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignMarkToStudentRequestData $request)
    {

        $exam =
            Exam::query()
                ->firstWhere(
                    'id',
                    $request->exam_id
                );

        $exam_attach_data =
            $request->exam_students->mapWithKeys(function (ExamStudentItemData $student) {

                return [$student->student_id => ['mark' => $student->mark]];

            })
                ->all();

        $exam
            ->students()
            ->attach($exam_attach_data);

    }
}
