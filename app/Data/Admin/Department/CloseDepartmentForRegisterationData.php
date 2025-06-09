<?php

namespace App\Data\Admin\Department;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema()]
class CloseDepartmentForRegisterationData extends Data
{
    public function __construct(

    ) {}

}
