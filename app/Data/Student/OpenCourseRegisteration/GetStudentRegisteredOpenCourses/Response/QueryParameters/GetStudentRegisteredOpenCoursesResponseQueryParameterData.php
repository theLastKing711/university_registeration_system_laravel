<?php

namespace App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCourses\Response\QueryParameters;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;

class GetStudentRegisteredOpenCoursesResponseQueryParameterData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
    ) {
        parent::__construct($page, $perPage);
    }
}
