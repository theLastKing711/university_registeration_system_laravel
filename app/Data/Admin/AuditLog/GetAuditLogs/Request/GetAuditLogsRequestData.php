<?php

namespace App\Data\Admin\AuditLog\GetAuditLogs\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;
use OpenApi\Attributes as OAT;

#[Oat\Schema()]
class GetAuditLogsRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
        #[OAT\Property]
        public ?string $action,
    ) {
        parent::__construct($page, $perPage);
    }
}
