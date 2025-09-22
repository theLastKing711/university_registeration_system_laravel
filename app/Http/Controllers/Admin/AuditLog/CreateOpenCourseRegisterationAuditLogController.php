<?php

namespace App\Http\Controllers\Admin\AuditLog;

use App\Data\Admin\AuditLog\OpenCourseRegisteration\CreateOpenCourseRegisterationAuditLog\Request\CreateOpenCourseRegisterationAuditLogRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

class CreateOpenCourseRegisterationAuditLogController extends Controller
{
    #[OAT\Post(path: '/admins/auditlogs', tags: ['adminsAuditLogs'])]
    #[JsonRequestBody(CreateOpenCourseRegisterationAuditLogRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateOpenCourseRegisterationAuditLogRequestData $request) {}
}
