<?php

namespace App\Data\Admin\Admin\UpdateAdmin\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAdminUpdateAdminResponseUpdateAdminResponseData')]
class UpdateAdminResponseData extends Data
{
    public function __construct(

    ) {}

}
