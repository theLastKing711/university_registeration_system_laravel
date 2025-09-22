<?php

namespace App\Http\Controllers\Admin\AuditLog\OpenCourseRegisteration;

use App\Data\Admin\AuditLog\OpenCourseRegisteration\CreateOpenCourseRegisterationAuditLog\Request\CreateOpenCourseRegisterationAuditLogRequestData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
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

        AuditLog::query()
            ->create([
                'user_id' => Auth::User()->id,
                'resource' => $request->resource,
                'action' => $request->action,
                'details' => $request->except('action')->toJson(),
            ]);

        return $request;
    }
}
