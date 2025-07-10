<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\UnRegisterOpenCourse\Request\UnRegisterOpenCourseRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\OpenCourseRegisteration\Abstract\OpenCourseRegisterationController;
use App\Models\StudentCourseRegisteration;
use App\Models\User;
use Auth;
use OpenApi\Attributes as OAT;

class UnRegisterOpenCourseController extends OpenCourseRegisterationController
{
    #[OAT\Delete(path: '/admins/open-course-registerations/{id}', tags: ['adminsOpenCourseRegisterations'])]
    #[SuccessNoContentResponse]
    public function __invoke(UnRegisterOpenCourseRequestData $request)
    {

        $logged_student =
            User::query()
                ->firstWhere(
                    'id',
                    Auth::User()->id
                );

        StudentCourseRegisteration::query()
            ->where(
                [
                    'student_id' => $logged_student->id,
                    'course_id' => $request->id,

                ]
            )
            ->delete();

    }
}
