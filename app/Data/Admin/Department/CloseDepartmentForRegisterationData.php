<?php

namespace App\Data\Admin\Department;

use App\Models\DepartmentRegisterationPeriod;
use Closure;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
#[MergeValidationRules]
class CloseDepartmentForRegisterationData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,

        #[
            OAT\PathParameter(
                parameter: 'CloseDepartmentForRegisterationPathParameterData', // the name used in ref
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('departments', 'id')
        ]
        public int $id,

    ) {}

    public static function rules(ValidationContext $context): array
    {

        Log::info($context->payload);

        $payload = $context->payload;

        return [
            'id' => function (string $attribute, mixed $value, Closure $fail) use ($payload) {

                $department_registeration_period = DepartmentRegisterationPeriod::query()
                    ->where(
                        'department_id',
                        $payload['id']
                    )
                    ->where(
                        'year',
                        $payload['year']
                    )
                    ->where(
                        'semester',
                        $payload['semester']
                    )
                    ->first();

                if ($department_registeration_period == null) {
                    $fail('لم يتم فتح الستجيل بعد للقسم والسنة والفصل المختارين');
                }

            },
        ];
    }
}
