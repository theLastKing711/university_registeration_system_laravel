<?php

namespace App\Data\Admin\Admin\GetOpenCourseRegisterations\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAdminGetOpenCourseRegisterationsResponseGetOpenCourseRegisterationsResponseData')]
class GetOpenCourseRegisterationsResponseData extends Data
{
    public function __construct(

    ) {
    }
}
