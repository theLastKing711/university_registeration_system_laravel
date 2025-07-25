<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\GetExam\Request\GetExamRequestData;
use App\Data\Admin\Exam\GetExam\Response\GetExamResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class GetExamController extends Controller
{
    #[OAT\Get(path: '/admins/exams/{id}', tags: ['adminsExams'])]
    #[SuccessItemResponse(GetExamResponseData::class)]
    public function __invoke(GetExamRequestData $request)
    {

        $course_exams =
            Exam::query()
                ->with(
                    [
                        'classroom',
                        'courseTeacher' => [
                            'teacher',
                        ],
                    ]
                )
                ->firstWhere(
                    'course_teacher_id',
                    $request->id
                );

        return $course_exams;

    }
}
