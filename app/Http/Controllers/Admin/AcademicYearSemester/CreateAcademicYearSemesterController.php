<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\CreateAcademicYearSemester\Request\CreateAcademicYearSemesterRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\AcademicYearSemester;
use OpenApi\Attributes as OAT;

class CreateAcademicYearSemesterController extends Controller
{
    #[OAT\Post(path: '/admins/academic-year-semesters', tags: ['adminsAcademicYearSemesters'])]
    #[JsonRequestBody(CreateAcademicYearSemesterRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateAcademicYearSemesterRequestData $request)
    {
        $academic_year_semester = new AcademicYearSemester;

        $academic_year_semester->year =
            $request->year;

        $academic_year_semester->semester
            = $request->semester;

        $academic_year_semester->save();

    }
}
