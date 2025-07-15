<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\AssignTeacherToCourse\Request\AssignTeacherToCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\OpenCourseRegisteration\Abstract\OpenCourseRegisterationTeacherController;
use App\Mail\TeacherCourseAssignmentEmail;
use App\Models\OpenCourseRegisteration;
use App\Models\Teacher;
use Illuminate\Support\Facades\Mail;
use OpenApi\Attributes as OAT;

class AssignTeacherToOpenCourseController extends OpenCourseRegisterationTeacherController
{
    #[OAT\Post(path: '/admins/open-course-registerations/{id}/teachers', tags: ['adminsOpenCourseRegisterations'])]
    #[JsonRequestBody(AssignTeacherToCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignTeacherToCourseRequestData $request)
    {

        $coruse_name =
            OpenCourseRegisteration::query()
                ->with('course')
                ->firstWhere(
                    'id',
                    $request->id
                )
                ->course
                ->name;

        $teacher_name =
            Teacher::query()
                ->firstWhere(
                    'id',
                    $request->id
                )
                ->name;

        OpenCourseRegisteration::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->teachers()
            ->attach(
                [$request->teacher_id],
                ['is_main_teacher' => $request->is_main_teacher]
            );

        Mail::to('lastking711@protonmail.com')
            ->send(
                new TeacherCourseAssignmentEmail(
                    $teacher_name,
                    $coruse_name
                )
            );

    }
}
