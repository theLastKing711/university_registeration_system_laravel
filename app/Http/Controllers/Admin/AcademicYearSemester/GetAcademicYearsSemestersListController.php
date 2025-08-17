<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\GetAcademicYearsSemestersList\Response\GetAcademicYearsSemestersListResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\AcademicYearSemester;
use OpenApi\Attributes as OAT;

class GetAcademicYearsSemestersListController extends Controller
{
    #[OAT\Get(path: '/admins/academic-year-semesters/list', tags: ['adminsAcademicYearSemesters'])]
    #[SuccessItemResponse(GetAcademicYearsSemestersListResponseData::class)]
    public function __invoke()
    {
        return GetAcademicYearsSemestersListResponseData::collect(
            AcademicYearSemester::query()
                ->select([
                    'id',
                    'year',
                    'semester',
                ])
                ->get()
        );
    }
}
