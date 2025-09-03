<?php

namespace App\Data\Admin\Department\GetDepartment\Request;

use App\Data\Admin\Department\Abstract\DepartmentData;
use OpenApi\Attributes as OAT;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminDepartmentGetDepartmentRequestGetDepartmentRequestData')]
class GetDepartmentRequestData extends DepartmentData {}
