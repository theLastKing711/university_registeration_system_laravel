<?php

namespace App\Data\Admin\Admin\GetAdmins\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;
use OpenApi\Attributes as OAT;

#[Oat\Schema()]
class GetAdminsRequestData extends PaginationQueryParameterData
{
    public function __construct(
        ?int $page,
        ?int $perPage,
    ) {
        parent::__construct($page, $perPage);
    }
}
