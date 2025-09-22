<?php

namespace App\Http\Controllers\Admin\AuditLog;

use App\Data\Admin\AuditLog\GetAuditLogs\Request\GetAuditLogsRequestData;
use App\Data\Admin\AuditLog\GetAuditLogs\Response\GetAuditLogsResponseData;
use App\Data\Admin\AuditLog\GetAuditLogs\Response\GetAuditLogsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use OpenApi\Attributes as OAT;

class GetAuditLogsController extends Controller
{
    #[OAT\Get(path: '/admins/audit-logs', tags: ['adminsAuditLogs'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetAuditLogsResponsePaginationResultData::class)]
    public function __invoke(GetAuditLogsRequestData $request)
    {
        return
            GetAuditLogsResponseData::collect(
                AuditLog::query()
                    ->paginate()
            );

        // return GetAuditLogsResponseData::collect(
        //     items: AuditLog::query()
        //         ->get()
        // );
    }
}
