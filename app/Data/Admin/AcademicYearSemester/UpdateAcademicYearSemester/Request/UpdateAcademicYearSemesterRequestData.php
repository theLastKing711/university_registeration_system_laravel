<?php

namespace App\Data\Admin\AcademicYearSemester\UpdateAcademicYearSemester\Request;

use App\Models\AcademicYearSemester;
use Closure;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterUpdateAcademicYearSemesterRequestUpdateAcademicYearSemesterRequestData')]
#[MergeValidationRules]
class UpdateAcademicYearSemesterRequestData extends Data
{
    public function __construct(

        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,

        #[
            OAT\PathParameter(
                parameter: 'adminsUpdateAcademicYearSemesterIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('academic_year_semesters', 'id')
        ]
        public int $id,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'year' => [
                function (string $attribute, mixed $value, Closure $fail) use ($context) {

                    $academic_year_semester =
                        AcademicYearSemester::query()
                            ->where(
                                'id',
                                '!=',
                                $context->payload['id']
                            )
                            ->where(
                                'year',
                                $value
                            )
                            ->where(
                                'semester',
                                $context->payload['semester']
                            )
                            ->first();

                    if ($academic_year_semester) {
                        $fail('السنة والفصل المضافيين موجودين مسبقا.');
                    }

                },
            ],
        ];
    }
}
