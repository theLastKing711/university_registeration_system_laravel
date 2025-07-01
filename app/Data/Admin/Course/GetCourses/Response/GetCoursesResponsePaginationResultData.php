<?php

namespace App\Data\Admin\Course\GetCourses\Response;

use App\Data\Shared\Pagination\PaginationResultData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseGetCoursesResponseGetCoursesResponsePaginationResultData')]
class GetCoursesResponsePaginationResultData  extends PaginationResultData
{
    /** @param Collection<int, GetCoursesResponseData> $data */
    public function __construct(
        int $current_page,
        int $per_page,
        #[ArrayProperty(GetCoursesResponseData::class)]
        public Collection $data,
        int $total,
    ) {
        parent::__construct($current_page, $per_page, $total);
    }
}

