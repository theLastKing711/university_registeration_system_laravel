<?php

namespace App\Data\Admin\GetUserRole\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminGetRoleResponseGetUserRoleRequestData')]
class GetUserRoleRequestData extends Data
{
    public function __construct(
        public ?string $resourse,
        public ?string $action
    ) {}

}
