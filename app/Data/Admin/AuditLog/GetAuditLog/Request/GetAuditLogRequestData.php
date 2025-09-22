<?php

namespace App\Data\Admin\AuditLog\GetAuditLog\Request;

use App\Models\AuditLog;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class GetAuditLogRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsGetAuditLogRequestPathParameterData', // the name used in ref
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists(AuditLog::class, 'id')
        ]
        public int $id,
    ) {}
}
