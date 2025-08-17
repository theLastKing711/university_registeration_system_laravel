<?php

namespace App\Data\Admin\Course\GetCourses\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;
use OpenApi\Attributes as OAT;

#[Oat\Schema()]
class GetCoursesRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
        public ?int $department_id,
        public ?int $academic_year_semester_id,
    ) {
        parent::__construct($page, $perPage);
    }
}
