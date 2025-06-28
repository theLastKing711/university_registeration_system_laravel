<?php

namespace App\Data\Admin\AcademicYearSemester\OpenDepartmentsForRegisteration\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\DepartmentRegisterationPeriod;
use Closure;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterOpenDepartmentsForRegisterationRequestOpenDepartmentsForRegisterationRequestData')]
class OpenDepartmentsForRegisterationRequestData extends Data
{
    public function __construct(
        #[
            ArrayProperty(),
            Exists('departments', 'id'),
        ]
        /** @var array<int> */
        public array $departments_ids,

        #[
            OAT\PathParameter(
                parameter: 'adminsAcademicYearSemesterOpenDepartmentsForRegisterationIdPathParameter',
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
            'departments_ids' => [
                function (string $attribute, mixed $value, Closure $fail) use ($context) {

                    $department_ids =
                        $context->payload['departments_ids'];

                    $academic_semester_year_id =
                        $context->payload['id'];

                    $duplicated_registered_departments_names =
                        DepartmentRegisterationPeriod::query()
                            ->with('department')
                            ->where(
                                'academic_year_semester_id',
                                $academic_semester_year_id
                            )
                            ->whereIn(
                                'department_id',
                                $department_ids
                            )
                            ->get()
                            ->pluck('department.name')
                            ->unique();

                    if ($duplicated_registered_departments_names->isNotEmpty()) {
                        $duplicated_departments_text =
                            implode(
                                ',',
                                $duplicated_registered_departments_names->toArray()
                            )
                            .
                            ' '
                            .
                            'الأقسام التالية مفتوحة مسبقا';

                        $fail($duplicated_departments_text);
                    }

                },
            ],
            'departments_ids.*' => ['integer'],
        ];
    }
}
