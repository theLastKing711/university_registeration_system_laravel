<?php

namespace App\Data\Admin\GetRole\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminGetRoleResponseGetUserRoleResponseData')]
class GetUserRoleResponseData extends Data
{
    public function __construct(
        // #[OAT\Property]
        // public int $id,
        // #[OAT\Property]
        // public string $name,
        #[
            OAT\Property,
        ]
        public bool $can_access,
    ) {}

}
