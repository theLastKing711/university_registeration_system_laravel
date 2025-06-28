<?php

namespace App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;
use OpenApi\Attributes as OAT;

#[Oat\Schema()]
class GetAcademicYearsSemestersRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
        #[OAT\property]
        public ?int $year,
        #[OAT\Property]
        public ?int $semester,
        #[OAT\Property]
        public ?int $department_id,

    ) {
        parent::__construct($page, $perPage);
    }
}
