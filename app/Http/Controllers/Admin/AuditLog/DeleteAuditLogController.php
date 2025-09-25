<?php

namespace App\Http\Controllers\Admin\AuditLog;

use App\Data\Admin\AuditLog\DeleteAuditLog\DeleteAuditLogRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\AuditLog\Abstract\AuditLogController;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class DeleteAuditLogController extends AuditLogController
{
    #[OAT\Delete(path: '/admins/audit-logs/{id}', tags: ['adminsAuditLogs'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteAuditLogRequestData $request)
    {

        AuditLog::query()
            ->create([
                'resource' => $request->resource,
                'action' => 'delete',
                'user_id' => Auth::User()->id,
                'details' => [
                    'id' => $request->id,
                ],
            ]);

    }
}
