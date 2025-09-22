<?php

namespace App\Data\Admin\AuditLog\GetAuditLogs\Response;

use App\Data\Shared\Pagination\PaginationResultData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
#[Oat\Schema(schema: 'AdminAuditLogGetAuditLogsResponseGetAuditLogsResponsePaginationResultData')]
class GetAuditLogsResponsePaginationResultData  extends PaginationResultData
{
    /** @param Collection<int, GetAuditLogsResponseData> $data */
    public function __construct(
        int $current_page,
        int $per_page,
        #[ArrayProperty(GetAuditLogsResponseData::class)]
        public Collection $data,
        int $total,
    ) {
        parent::__construct($current_page, $per_page, $total);
    }
}

