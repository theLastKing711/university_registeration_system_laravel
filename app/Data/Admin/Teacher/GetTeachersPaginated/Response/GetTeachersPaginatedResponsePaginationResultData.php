<?php

namespace App\Data\Admin\Teacher\GetTeachersPaginated\Response;

use App\Data\Shared\Pagination\PaginationResultData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
#[Oat\Schema(schema: 'AdminTeacherGetTeachersPaginatedResponseGetTeachersPaginatedResponsePaginationResultData')]
class GetTeachersPaginatedResponsePaginationResultData  extends PaginationResultData
{
    /** @param Collection<int, GetTeachersPaginatedResponseData> $data */
    public function __construct(
        int $current_page,
        int $per_page,
        #[ArrayProperty(GetTeachersPaginatedResponseData::class)]
        public Collection $data,
        int $total,
    ) {
        parent::__construct($current_page, $per_page, $total);
    }
}

