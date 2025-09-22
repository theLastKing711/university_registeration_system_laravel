<?php

namespace App\Http\Controllers\Admin\AuditLog;

use App\Data\Admin\AuditLog\CreateAuditLog\Request\CreateAuditLogRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class CreateAuditLogController extends Controller
{
    #[OAT\Post(path: '/admins/audit-logs', tags: ['adminsAuditLogs'])]
    #[JsonRequestBody(CreateAuditLogRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateAuditLogRequestData $request)
    {

        // AuditLog
        //     ::create([
        //         'user_id' => Auth::User()->id,
        //         'resource' => $request->res
        //     ])

    }
}
