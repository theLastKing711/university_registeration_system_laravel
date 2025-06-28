<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\OpenDepartmentsForRegisteration\Request\OpenDepartmentsForRegisterationRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\AcademicYearSemester\Abstract\AcademicYearSemesterDepartmentController;
use App\Models\AcademicYearSemester;
use OpenApi\Attributes as OAT;

class OpenDepartmentsForRegisterationController extends AcademicYearSemesterDepartmentController
{
    #[OAT\Post(path: '/admins/academic-year-semesters/{id}/departments', tags: ['adminsAcademicYearSemesters'])]
    #[JsonRequestBody(OpenDepartmentsForRegisterationRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(OpenDepartmentsForRegisterationRequestData $request)
    {

        AcademicYearSemester::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->departments()
            ->attach(
                $request->departments_ids,
                ['is_open_for_students' => false]
            );

    }
}
