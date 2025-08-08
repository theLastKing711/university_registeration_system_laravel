<?php

namespace App\Data\Admin\Student\RegisterStudent\Request;

use App\Data\Shared\Casts\ArrayToCollectionCast;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class RegisterStudentRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?int $department_id,
        #[OAT\Property]
        public string $national_id,
        #[
            DateProperty,
        ]
        public Carbon $birthdate,
        #[
            DateProperty,
        ]
        public Carbon $enrollment_date,
        #[OAT\Property]
        public string $phone_number,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $password,

        #[OAT\Property]
        public ?string $temporary_profile_picture_id,

        #[
            ArrayProperty('integer'),
            WithCast(ArrayToCollectionCast::class),
            Exists('temporary_uploaded_images', 'id')
        ]
        /** @var Collection<int> */
        public ?Collection $school_files_ids_to_add,

    ) {}
}
