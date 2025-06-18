<?php

namespace App\Data\Admin\Admin\CreateAdmin\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class CreateAdminRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $password,
    ) {}
}
