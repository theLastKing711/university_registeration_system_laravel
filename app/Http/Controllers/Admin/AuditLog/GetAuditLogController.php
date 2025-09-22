<?php

namespace App\Http\Controllers\Admin\AuditLog;

use App\Data\Admin\AuditLog\GetAuditLog\Request\GetAuditLogRequestData;
use App\Data\Admin\AuditLog\GetAuditLog\Response\GetAuditLogResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use OpenApi\Attributes as OAT;

class GetAuditLogController extends Controller
{
    #[OAT\Get(path: '/admins/audit-logs/{id}', tags: ['adminsAuditLogs'])]
    #[SuccessItemResponse(GetAuditLogResponseData::class)]
    public function __invoke(GetAuditLogRequestData $request)
    {
        return GetAuditLogResponseData::from(
            AuditLog::query()
                ->firstWhere(
                    'id',
                    $request->id
                )
        );
    }
}
