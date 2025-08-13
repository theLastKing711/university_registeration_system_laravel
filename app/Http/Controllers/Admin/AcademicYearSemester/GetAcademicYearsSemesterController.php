<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\GetcademicYearsSemester\Request\GetAcademicYearsSemesterRequestData;
use App\Data\Admin\AcademicYearSemester\GetcademicYearsSemester\Response\GetAcademicYearsSemesterResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Admin\AcademicYearSemester\Abstract\AcademicYearSemesterController;
use App\Models\AcademicYearSemester;
use OpenApi\Attributes as OAT;

class GetAcademicYearsSemesterController extends AcademicYearSemesterController
{
    #[OAT\Get(path: '/admins/academic-year-semesters/{id}', tags: ['adminsAcademicYearSemesters'])]
    #[SuccessItemResponse(GetAcademicYearsSemesterResponseData::class)]
    public function __invoke(GetAcademicYearsSemesterRequestData $request)
    {
        return GetAcademicYearsSemesterResponseData::from(
            AcademicYearSemester::query()
                ->with('departmentRegisterationPeriods.department')
                ->firstWhere(
                    'id',
                    $request->id
                )
        );
    }
}
