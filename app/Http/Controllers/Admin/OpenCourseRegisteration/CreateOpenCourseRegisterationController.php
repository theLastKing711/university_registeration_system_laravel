<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\CreateOpenCourseRegisteration\Request\CreateOpenCourseRegisterationRequestData;
use App\Data\Admin\OpenCourseRegisteration\CreateOpenCourseRegisteration\Request\CreateTeacherData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use App\Services\API\StripeService;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class CreateOpenCourseRegisterationController extends Controller
{
    #[OAT\Post(path: '/admins/open-course-registerations', tags: ['adminsOpenCourseRegisterations'])]
    #[JsonRequestBody(CreateOpenCourseRegisterationRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateOpenCourseRegisterationRequestData $request, StripeService $stripeService)
    {

        DB::transaction(function () use ($request, $stripeService) {

            $open_course =
                OpenCourseRegisteration::query()
                    ->create([
                        'course_id' => $request->course_id,
                        'academic_year_semester_id' => $request->academic_year_semester_id,
                        'price_in_usd' => $request->price_in_usd,
                    ]);

            $teachers_attach_data =
                $request
                    ->teachers
                    ->mapWithKeys(function (CreateTeacherData $teacher) {
                        return [
                            $teacher->id => [
                                'is_main_teacher' => $teacher->is_main_teacher,
                            ],
                        ];
                    })
                    ->all();

            $open_course
                ->teachers()
                ->attach($teachers_attach_data);

            $stripeService
                ->createOpenCourseProduct(
                    $open_course
                );

        });

    }
}
