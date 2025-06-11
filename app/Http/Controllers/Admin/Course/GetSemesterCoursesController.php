<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetSemesterCoursesResponseData;
use App\Data\Admin\Department\PathParameters\DepartmentIdPathParameterData;
use App\Data\Admin\QueryParameters\YearSemesterQueryParameterData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/courses/getSemesterCourses/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsDepartmentIdPathParameterData',
            ),
        ],
    ),
]
class GetSemesterCoursesController extends Controller
{
    #[QueryParameter('year', 'integer')]
    #[QueryParameter('semester', 'integer')]
    #[OAT\Get(path: '/admins/courses/getSemesterCourses/{id}', tags: ['adminsCourses'])]
    #[SuccessListResponse(GetSemesterCoursesResponseData::class)]
    public function __invoke(
        DepartmentIdPathParameterData $departmentPathData,
        YearSemesterQueryParameterData $yearSemesterQueryParameter
    ) {

        return
            OpenCourseRegisteration::query()
                ->with('course')
                ->where('year', $yearSemesterQueryParameter->year)
                ->where('semester', $yearSemesterQueryParameter->semester)
                ->whereRelation(
                    'course.department',
                    'id',
                    $departmentPathData->id
                )
                ->get();
    }
}
