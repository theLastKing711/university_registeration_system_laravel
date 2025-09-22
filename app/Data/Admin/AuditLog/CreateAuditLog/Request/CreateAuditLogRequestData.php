<?php

namespace App\Data\Admin\AuditLog\CreateAuditLog\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAuditLogCreateAuditLogRequestCreateAuditLogRequestData')]
class CreateAuditLogRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $resource,
        #[OAT\Property]
        public string $action,
    ) {}

}
