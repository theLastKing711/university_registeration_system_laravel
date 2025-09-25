<?php

namespace App\Http\Controllers\Admin\AuditLog\Teacher;

use App\Data\Admin\AuditLog\Teacher\CreateTeacherAuditLog\Request\CreateTeacherAuditLogRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class CreateTeacherAuditLogController extends Controller
{
    #[OAT\Post(path: '/admins/auditlogs/teachers', tags: ['adminsAuditLogs'])]
    #[JsonRequestBody(CreateTeacherAuditLogRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateTeacherAuditLogRequestData $request)
    {
        if ($request->action === 'create') {

            $teacher =
                Teacher::query()
                    ->firstWhere(
                        'name',
                        $request->name
                    );

            AuditLog::query()
                ->create([
                    'user_id' => Auth::User()->id,
                    'resource' => $request->resource,
                    'action' => $request->action,
                    'details' => [
                        'id' => $teacher->id,
                        'name' => $teacher->name,
                        'department_id' => $request->department_id,
                    ],
                ]);

            return;
        }

        AuditLog::query()
            ->create([
                'user_id' => Auth::User()->id,
                'resource' => $request->resource,
                'action' => $request->action,
                'details' => [
                    'id' => $request->id,
                    'resource' => $request->resource,
                    'name' => $request->previousData->name,
                    'department_id' => $request->department_id,
                    'updated_name' => $request->name,
                    'updated_departmen_id' => $request->previousData->department_id,
                ],
            ]);

    }
}
