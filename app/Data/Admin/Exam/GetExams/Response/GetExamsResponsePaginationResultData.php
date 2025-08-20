<?php

namespace App\Data\Admin\Exam\GetExams\Response;

use App\Data\Shared\Pagination\PaginationResultData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
#[Oat\Schema(schema: 'AdminExamGetExamsResponseGetExamsResponsePaginationResultData')]
class GetExamsResponsePaginationResultData  extends PaginationResultData
{
    /** @param Collection<int, GetExamsResponseData> $data */
    public function __construct(
        int $current_page,
        int $per_page,
        #[ArrayProperty(GetExamsResponseData::class)]
        public Collection $data,
        int $total,
    ) {
        parent::__construct($current_page, $per_page, $total);
    }
}

