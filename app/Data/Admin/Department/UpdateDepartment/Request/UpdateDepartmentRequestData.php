<?php

namespace App\Data\Admin\Department\UpdateDepartment\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminDepartmentUpdateDepartmentRequestUpdateDepartmentRequestData')]
class UpdateDepartmentRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,

        #[
            OAT\PathParameter(
                parameter: 'adminsDepartmentUpdateDepartmentIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('departments', 'id')
        ]
        public int $id,
    ) {}
}
