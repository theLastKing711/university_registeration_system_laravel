<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\GetStudentsList\Request\GetStudentsListRequestData;
use App\Data\Admin\Student\GetStudentsList\Response\GetStudentsListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class GetStudentsListController extends Controller
{
    #[OAT\Get(path: '/admins/students', tags: ['adminsStudents'])]
    #[SuccessListResponse(GetStudentsListResponseData::class)]
    public function __invoke(GetStudentsListRequestData $request)
    {

        // return
        //     OpenCourseRegisteration::query()
        //         ->with('students:id,name')
        //         ->firstWhere(
        //             'id',
        //             $request->course_id
        //         );

        if (! isset($request->course_id)) {
            return [];
        }

        return GetStudentsListResponseData::collect(
            OpenCourseRegisteration::query()
                ->with('students:id,name')
                ->firstWhere(
                    'id',
                    $request->course_id
                )
                ->students
        );

    }
}
