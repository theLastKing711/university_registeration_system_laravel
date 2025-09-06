<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Data\Student\OpenCourseRegisteration\UnRegisterFromOpenCourse\Request\UnRegisterFromOpenCourseRequestData;
use App\Http\Controllers\Student\OpenCourseRegisteration\Abstract\OpenCourseRegisterationController;
use App\Models\StudentCourseRegisteration;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class UnRegisterFromOpenCourseController extends OpenCourseRegisterationController
{
    #[OAT\Delete(path: '/students/open-course-registerations/{id}', tags: ['studentsOpenCourseRegisterations'])]
    #[SuccessNoContentResponse]
    public function __invoke(UnRegisterFromOpenCourseRequestData $request)
    {

        StudentCourseRegisteration::query()
            ->firstWhere(
                [
                    'course_id' => $request->id,
                    'student_id' => Auth::User()->id,
                ]
            )
            ->delete();

    }
}
