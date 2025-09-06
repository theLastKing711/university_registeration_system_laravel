<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemester\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;

class GetStudentRegisteredOpenCoursesThisSemesterRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
        public ?string $query,
    ) {
        parent::__construct($page, $perPage);
    }
}
