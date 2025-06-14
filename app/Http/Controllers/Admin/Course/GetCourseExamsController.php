<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetCourseExamsData;
use App\Data\Admin\Course\GetCourseExamsRequestData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/courses/{id}/getCourseExams',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/getCourseExamsDataPathParameter',
            ),
        ],
    )
]
class GetCourseExamsController extends Controller
{
    #[OAT\Get(path: '/admins/courses/{id}/getCourseExams', tags: ['adminsCourses'])]
    #[SuccessListResponse(GetCourseExamsData::class)]
    public function __invoke(GetCourseExamsRequestData $request)
    {

        $course_exams =
            Exam::query()
                ->where(
                    'course_teacher_id',
                    $request->id
                )
                ->get();

        return $course_exams;
    }
}
