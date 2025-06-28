<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;


use App\Http\Controllers\Controller;

use App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Response\GetAcademicYearsSemestersResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use OpenApi\Attributes as OAT;

class GetAcademicYearsSemestersController extends Controller
{

    #[OAT\Get(path: '/admins/academicyearsemesters', tags: ['adminsAcademicYearSemesters'])]
    #[SuccessListResponse(GetAcademicYearsSemestersResponseData::class)]
    public function __invoke()
    {

    }
}
