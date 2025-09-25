<?php

namespace App\Http\Controllers\Admin\AuditLog\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/audit-logs/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/AuditLogIdPathParameter',
            ),
        ],
    ),
]
abstract class AuditLogController extends Controller {}
