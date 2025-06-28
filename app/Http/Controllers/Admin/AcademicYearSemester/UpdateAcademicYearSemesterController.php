<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\UpdateAcademicYearSemester\Request\UpdateAcademicYearSemesterRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\AcademicYearSemester\Abstract\AcademicYearSemesterController;
use App\Models\AcademicYearSemester;
use OpenApi\Attributes as OAT;

class UpdateAcademicYearSemesterController extends AcademicYearSemesterController
{
    #[OAT\Patch(path: '/admins/academic-year-semesters/{id}', tags: ['adminsAcademicYearSemesters'])]
    #[JsonRequestBody(UpdateAcademicYearSemesterRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateAcademicYearSemesterRequestData $request)
    {
        AcademicYearSemester::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update([
                'year' => $request->year,
                'semester' => $request->semester,
            ]);

    }
}
