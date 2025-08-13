<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\UpdateAcademicYearSemester\Request\UpdateAcademicYearSemesterRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\AcademicYearSemester\Abstract\AcademicYearSemesterController;
use App\Models\AcademicYearSemester;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class UpdateAcademicYearSemesterController extends AcademicYearSemesterController
{
    #[OAT\Patch(path: '/admins/academic-year-semesters/{id}', tags: ['adminsAcademicYearSemesters'])]
    #[JsonRequestBody(UpdateAcademicYearSemesterRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateAcademicYearSemesterRequestData $request)
    {

        DB::transaction(function () use ($request) {

            $academic_year_semester =
                AcademicYearSemester::query()
                    ->firstWhere(
                        'id',
                        $request->id
                    );

            $academic_year_semester->update([
                'year' => $request->year,
                'semester' => $request->semester,
            ]);

            $departments_attach_data =
                $request
                    ->departments
                    ->mapWithKeys(fn ($department) => [
                        $department->id => [
                            'is_open_for_students' => $department->is_open_for_students,
                        ],
                    ]
                    )
                    ->all();

            $academic_year_semester
                ->departments()
                ->sync($departments_attach_data);

        });

    }
}
