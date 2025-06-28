<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\DeleteAcademicYearSemester\Request\DeleteAcademicYearSemesterRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\AcademicYearSemester\Abstract\AcademicYearSemesterController;
use App\Models\AcademicYearSemester;
use OpenApi\Attributes as OAT;

class DeleteAcademicYearSemesterController extends AcademicYearSemesterController
{
    #[OAT\Delete(path: '/admins/academic-year-semesters/{id}', tags: ['adminsAcademicYearSemesters'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteAcademicYearSemesterRequestData $request)
    {

        AcademicYearSemester::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();

    }
}
