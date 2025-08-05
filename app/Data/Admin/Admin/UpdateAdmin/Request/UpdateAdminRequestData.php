<?php

namespace App\Data\Admin\Admin\UpdateAdmin\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAdminUpdateAdminRequestUpdateAdminRequestData')]
class UpdateAdminRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public ?string $password,

        #[
            OAT\PathParameter(
                parameter: 'adminsAdminsUpdateAdminIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('users', 'id')
        ]
        public int $id,
    ) {}

}
