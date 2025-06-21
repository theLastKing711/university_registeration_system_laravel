<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCourses\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;

class GetStudentRegisteredOpenCoursesRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
    ) {
        parent::__construct($page, $perPage);
    }
}
