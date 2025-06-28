<?php

namespace App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterGetcademicYearsSemestersResponseGetAcademicYearsSemestersResponseData')]
class GetAcademicYearsSemestersResponseData extends Data
{
    public function __construct(

    ) {}

}
