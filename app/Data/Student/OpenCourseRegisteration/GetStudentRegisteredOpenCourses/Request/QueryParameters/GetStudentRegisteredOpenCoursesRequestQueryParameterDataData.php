<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCourses\Request\QueryParameters;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;

class GetStudentRegisteredOpenCoursesRequestQueryParameterData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
    ) {
        parent::__construct($page, $perPage);
    }
}
