<?php

namespace App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationList\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminOpenCourseRegisterationGetOpenCourseRegisterationListResponseGetOpenCourseRegisterationListResponseData')]
class GetOpenCourseRegisterationListResponseData extends Data
{
    public function __construct(

    ) {}

}
