<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;

class GetCoursesMarksRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
    ) {
        parent::__construct($page, $perPage);
    }
}
