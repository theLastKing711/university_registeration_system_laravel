<?php

namespace App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationList\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminOpenCourseRegisterationGetOpenCourseRegisterationListRequestGetOpenCourseRegisterationListRequestData')]
class GetOpenCourseRegisterationListRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?int $department_id,
        #[OAT\Property]
        public ?int $academic_year_semester_id,
    ) {}

}
