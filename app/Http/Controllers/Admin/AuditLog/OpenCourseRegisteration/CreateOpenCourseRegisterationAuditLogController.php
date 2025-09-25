<?php

namespace App\Http\Controllers\Admin\AuditLog\OpenCourseRegisteration;

use App\Data\Admin\AuditLog\OpenCourseRegisteration\CreateOpenCourseRegisterationAuditLog\Request\CreateOpenCourseRegisterationAuditLogRequestData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\OpenCourseRegisteration;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class CreateOpenCourseRegisterationAuditLogController extends Controller
{
    #[OAT\Post(path: '/admins/audit-logs\open-course-registerations', tags: ['adminsAuditLogs'])]
    #[QueryParameter('action')]
    #[JsonRequestBody(CreateOpenCourseRegisterationAuditLogRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateOpenCourseRegisterationAuditLogRequestData $request)
    {

        if ($request->action === 'create') {

            $open_course_registeration =
                OpenCourseRegisteration::query()
                    ->where(
                        [
                            'course_id' => $request->course_id,
                            'academic_year_semester_id' => $request->academic_year_semester_id,
                        ]
                    )
                    ->first();

            AuditLog::query()
                ->create([
                    'user_id' => Auth::User()->id,
                    'resource' => $request->resource,
                    'action' => $request->action,
                    'details' => [
                        'id' => $open_course_registeration->id,
                        'course_id' => $request->course_id,
                        'academic_year_semester_id' => $request->academic_year_semester_id,
                        'price_in_usd' => $request->price_in_usd,
                        'teachers' => $request->teachers,
                    ],
                ]);

            return;
        }

        AuditLog::query()
            ->create([
                'user_id' => Auth::User()->id,
                'resource' => $request->resource,
                'action' => $request->action,
                'details' => [
                    'id' => $request->id,
                    'course_id' => $request->previousData->course_id,
                    'academic_year_semester_id' => $request->previousData->academic_year_semester_id,
                    'price_in_usd' => $request->previousData->price_in_usd,
                    'teachers' => $request->previousData->teachers,

                    'updated_course_id' => $request->course_id,
                    'update_academic_year_semester_id' => $request->academic_year_semester_id,
                    'updated_price_in_usd' => $request->price_in_usd,
                    'updated_teachers' => $request->teachers,

                ],
            ]);

    }
}
