<?php

namespace App\Data\Admin\Department\UpdateDepartment\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminDepartmentUpdateDepartmentResponseUpdateDepartmentResponseData')]
class UpdateDepartmentResponseData extends Data
{
    public function __construct(

    ) {}

}
