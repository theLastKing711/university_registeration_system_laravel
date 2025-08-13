<?php

namespace App\Data\Admin\AcademicYearSemester\GetcademicYearsSemester\Request;

use App\Models\AcademicYearSemester;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterGetcademicYearsSemesterRequestGetcademicYearsSemesterRequestData')]
class GetAcademicYearsSemesterRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'GetcademicYearsSemesterRequestDataIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists(AcademicYearSemester::class, 'id')
        ]
        public int $id,
    ) {}

}
