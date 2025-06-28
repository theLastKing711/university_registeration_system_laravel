<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Request\GetAcademicYearsSemestersRequestData;
use App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Response\GetAcademicYearsSemestersResponseData;
use App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Response\GetAcademicYearsSemestersResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\AcademicYearSemester;
use Illuminate\Database\Eloquent\Builder;
use OpenApi\Attributes as OAT;

class GetAcademicYearsSemestersController extends Controller
{
    #[OAT\Get(path: '/admins/academic-year-semesters', tags: ['adminsAcademicYearSemesters'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[QueryParameter('semester', 'integer')]
    #[QueryParameter('year', 'integer')]
    #[SuccessItemResponse(GetAcademicYearsSemestersResponsePaginationResultData::class)]
    public function __invoke(GetAcademicYearsSemestersRequestData $request)
    {

        $academic_years_semesters =
            AcademicYearSemester::query()
                ->when(
                    $request->year,
                    fn (Builder $query) => $query
                        ->where(
                            'year',
                            $request->year
                        )
                )
                ->when(
                    $request->semester,
                    fn (Builder $query) => $query
                        ->where(
                            'semester',
                            $request->semester
                        )
                )
                ->paginate($request->perPage);

        return
            GetAcademicYearsSemestersResponseData::collect(
                $academic_years_semesters
            );

    }
}
