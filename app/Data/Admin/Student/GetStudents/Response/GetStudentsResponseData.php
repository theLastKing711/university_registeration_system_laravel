<?php

namespace App\Data\Admin\Student\GetStudents\Response;

use App\Data\Shared\Swagger\Property\DateProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAdminGetStudentsResponseGetStudentsResponseData')]
class GetStudentsResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?int $department_id,
        #[OAT\Property]
        public ?string $national_id,
        #[DateProperty]
        public ?string $birthdate,
        #[DateProperty]
        public ?string $enrollment_date,
        #[DateProperty]
        public ?string $graduation_date,
        #[OAT\Property]
        public ?string $phone_number,
        #[OAT\Property]
        public string $name,
    ) {}
}
