<?php

namespace App\Data\Admin\AuditLog\GetAuditLogs\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAuditLogGetAuditLogsResponseGetAuditLogsResponseData')]
class GetAuditLogsResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $resource,
        #[OAT\Property]
        public string $action,
        #[OAT\Property]
        public $details,

    ) {}
}
