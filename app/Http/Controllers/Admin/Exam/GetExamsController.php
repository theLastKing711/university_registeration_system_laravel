<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\GetExams\Request\GetExamsRequestData;
use App\Data\Admin\Exam\GetExams\Response\GetExamsResponseData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class GetExamsController extends Controller
{
    #[OAT\Get(path: '/admins/exams', tags: ['adminsExams'])]
    #[QueryParameter('course_teacher_id')]
    #[SuccessListResponse(GetExamsResponseData::class)]
    public function __invoke(GetExamsRequestData $request)
    {
        $teacher_exams =
            Exam::query()
                ->with(
                    [
                        'classroom',
                        'courseTeacher' => [
                            'teacher',
                        ],
                    ]
                )
                ->where(
                    'course_teacher_id',
                    $request
                        ->course_teacher_id
                )
                ->get();

        return GetExamsResponseData::collect($teacher_exams);

    }
}
