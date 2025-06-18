<?php

namespace App\Data\Admin\Admin\DeleteAdmin\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class DeleteAdminRequestData extends Data
{
    public function __construct(
        #[ArrayProperty]
        public Collection $ids,
    ) {}
}
