<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCourses\Request;

use App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCourses\Request\GetStudentRegisteredOpenCoursesRequestData;
use App\Data\Shared\Pagination\PaginationResultData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema()]
class GetStudentRegisteredOpenCoursesRequestPaginationResultData  extends PaginationResultData
{
    /** @param Collection<int, GetStudentRegisteredOpenCoursesRequestData> $data */
    public function __construct(
        int $current_page,
        int $per_page,
        #[ArrayProperty(GetStudentRegisteredOpenCoursesRequestData::class)]
        public Collection $data,
        int $total
    ) {
        parent::__construct($current_page, $per_page, $total);
    }
}

