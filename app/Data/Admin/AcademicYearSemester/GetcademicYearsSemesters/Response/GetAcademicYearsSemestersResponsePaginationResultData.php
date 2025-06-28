<?php

namespace App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Response;

use App\Data\Shared\Pagination\PaginationResultData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterGetcademicYearsSemestersResponseGetAcademicYearsSemestersResponsePaginationResultData')]
class GetAcademicYearsSemestersResponsePaginationResultData  extends PaginationResultData
{
    /** @param Collection<int, GetAcademicYearsSemestersResponseData> $data */
    public function __construct(
        int $current_page,
        int $per_page,
        #[ArrayProperty(GetAcademicYearsSemestersResponseData::class)]
        public Collection $data,
        int $total,
    ) {
        parent::__construct($current_page, $per_page, $total);
    }
}

