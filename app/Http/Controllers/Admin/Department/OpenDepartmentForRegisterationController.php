<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\OpenDepartmentForRegisteration\Request\OpenDepartmentForRegisterationData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\DepartmentRegisterationPeriod;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/departments/{id}/open-for-registerations',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsDepartmentIdPathParameterData',
            ),
        ],
    ),
]
class OpenDepartmentForRegisterationController extends Controller
{
    #[OAT\Patch(path: '/admins/departments/{id}/open-for-registerations', tags: ['adminsDepartments'])]
    #[JsonRequestBody(OpenDepartmentForRegisterationData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(
        OpenDepartmentForRegisterationData $request
    ) {

        $deprtment_registeration_period_opened_previously =
            DepartmentRegisterationPeriod::query()
                ->where(
                    'department_id',
                    $request->id
                )
                ->where(
                    'year',
                    $request->course_registeration_year
                )
                ->where(
                    'semester',
                    $request->course_registeration_semester
                )
                ->first();

        if ($deprtment_registeration_period_opened_previously) {
            $deprtment_registeration_period_opened_previously
                ->update([
                    'is_open_for_students' => true,
                ]);

            return;
        }

        $deprtment_registeration_period =
            new DepartmentRegisterationPeriod;

        $deprtment_registeration_period->year =
             $request->course_registeration_year;

        $deprtment_registeration_period->semester =
            $request->course_registeration_semester;

        $deprtment_registeration_period->department_id =
             $request->id;

        $deprtment_registeration_period->is_open_for_students =
            true;

        $deprtment_registeration_period
            ->save();

    }
}
