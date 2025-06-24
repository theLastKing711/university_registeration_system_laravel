<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemester\Response;

use App\Data\Shared\Pagination\PaginationResultData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetStudentRegisteredOpenCoursesThisSemesterResponsePaginationResultData extends PaginationResultData
{
    /** @param Collection<int, GetStudentRegisteredOpenCoursesThisSemesterResponseData> $data */
    public function __construct(
        int $current_page,
        int $per_page,
        #[ArrayProperty(GetStudentRegisteredOpenCoursesThisSemesterResponseData::class)]
        public Collection $data,
        int $total,
    ) {
        parent::__construct($current_page, $per_page, $total);
    }
}
