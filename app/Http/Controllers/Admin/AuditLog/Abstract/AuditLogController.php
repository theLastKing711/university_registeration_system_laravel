<?php

namespace App\Http\Controllers\Admin\AuditLog\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/auditlogs/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/testIdPathParameter',
            ),
        ],
    ),
]
class AuditLogController extends Controller
{

    #[OAT\Get(path: '/admins/auditlogs', tags: ['adminsAuditLogs'])]
    public function __invoke()
    {

    }
}
