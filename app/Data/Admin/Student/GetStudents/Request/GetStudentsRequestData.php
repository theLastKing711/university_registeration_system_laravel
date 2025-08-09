<?php

namespace App\Data\Admin\Student\GetStudents\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;
use App\Enum\SortDirection;
use OpenApi\Attributes as OAT;

#[Oat\Schema()]
class GetStudentsRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,

        public ?string $query,

        public ?string $sort,

        public ?SortDirection $dir,

        public ?int $department_id,

        public ?int $enrollment_year,
    ) {
        parent::__construct($page, $perPage);
    }
}
