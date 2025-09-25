<?php

namespace App\Data\Admin\AuditLog\Teacher\CreateTeacherAuditLog\Request;

use App\Data\Admin\Teacher\CreateTeacher\Request\CreateTeacherRequestData;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAuditLogTeacherCreateTeacherAuditLogRequestCreateTeacherAuditLogRequestData')]
class CreateTeacherAuditLogRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?int $id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public int $department_id,
        #[OAT\Property]
        public string $resource,
        public string $action,

        #[OAT\Property]
        public ?string $updated_name,
        #[OAT\Property]
        public ?CreateTeacherRequestData $previousData
    ) {}

}
