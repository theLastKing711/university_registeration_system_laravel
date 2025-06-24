<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemester\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;

class GetStudentRegisteredOpenCoursesThisSemesterRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
    ) {
        parent::__construct($page, $perPage);
    }
}
