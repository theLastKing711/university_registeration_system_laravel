<?php

namespace App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;

class GetCoursesMarksRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
        public ?string $query,
    ) {
        parent::__construct($page, $perPage);
    }
}
