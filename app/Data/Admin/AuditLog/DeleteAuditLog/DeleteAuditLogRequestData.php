<?php

namespace App\Data\Admin\AuditLog\DeleteAuditLog;

use App\Models\AuditLog;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAuditLogDeleteAuditLogDeleteAuditLogRequestData')]
class DeleteAuditLogRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $resource,

        // #[
        //     OAT\PathParameter(
        //         parameter: 'DeleteAuditLogIdPathParameter',
        //         name: 'id',
        //         schema: new OAT\Schema(
        //             type: 'integer',
        //         ),
        //     ),
        //     FromRouteParameter('id'),
        //     Exists(AuditLog::class, 'id')
        // ]
        // public int $id,
    ) {}

}
