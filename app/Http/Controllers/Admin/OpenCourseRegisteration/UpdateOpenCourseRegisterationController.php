<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\UpdateOpenCourseRegisteration\Request\UpdateOpenCourseRegisterationRequestData;
use App\Data\Admin\OpenCourseRegisteration\UpdateOpenCourseRegisteration\Request\UpdateTeacherData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/opencourseregisterations/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/usersTestPathParameterData',
            ),
        ],
    ),
]
class UpdateOpenCourseRegisterationController extends Controller
{
    #[OAT\Patch(path: '/admins/opencourseregisterations/{id}', tags: ['adminsOpenCourseRegisterations'])]
    #[JsonRequestBody(UpdateOpenCourseRegisterationRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateOpenCourseRegisterationRequestData $request)
    {
        DB::transaction(function () use ($request) {

            $open_course =
                OpenCourseRegisteration::query()
                    ->firstWhere(
                        'id',
                        $request->id
                    );

            $open_course
                ->update([
                    'course_id' => $request->course_id,
                    'academic_year_semester_id' => $request->academic_year_semester_id,
                    'price_in_usd' => $request->price_in_usd,
                ]);

            $teachers_attach_data =
                $request
                    ->teachers
                    ->mapWithKeys(function (UpdateTeacherData $teacher) {
                        return [
                            $teacher->id => [
                                'is_main_teacher' => $teacher->is_main_teacher,
                            ],
                        ];
                    })
                    ->all();

            $open_course
                ->teachers()
                ->sync($teachers_attach_data);

        });
    }
}
