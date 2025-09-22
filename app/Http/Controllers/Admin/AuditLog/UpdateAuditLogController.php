<?php

namespace App\Http\Controllers\Admin\AuditLog;

use App\Data\Admin\AuditLog\UpdateAuditLog\Request\UpdateAuditLogRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

class UpdateAuditLogController extends Controller
{
    #[OAT\Patch(path: '/admins/auditlogs/{id}', tags: ['adminsAuditLogs'])]
    #[JsonRequestBody(UpdateAuditLogRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateAuditLogRequestData $request) {}
}
