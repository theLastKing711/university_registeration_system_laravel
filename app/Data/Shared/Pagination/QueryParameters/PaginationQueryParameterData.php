<?php

namespace App\Data\Shared\Pagination\QueryParameters;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;

#[Oat\Schema()]
class PaginationQueryParameterData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?int $page,
        #[OAT\Property]
        public ?int $perPage,
    ) {}
}
