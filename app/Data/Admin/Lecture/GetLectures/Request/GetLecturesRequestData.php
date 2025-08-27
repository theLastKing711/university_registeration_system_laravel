<?php

namespace App\Data\Admin\Lecture\GetLectures\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;
use OpenApi\Attributes as OAT;

#[Oat\Schema()]
class GetLecturesRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
        public ?int $department_id,
        public ?int $academic_year_semester_id,
        public ?int $course_id,
    ) {
        parent::__construct($page, $perPage);
    }
}
