<?php

namespace App\Data\Admin\Student\UpdateStudent\Request;

use App\Data\Shared\Casts\ArrayToCollectionCast;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Present;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class UpdateStudentRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?int $department_id,
        #[OAT\Property]
        public string $national_id,
        #[DateProperty]
        public Carbon $birthdate,
        #[DateProperty]
        public ?Carbon $enrollment_date,
        #[DateProperty]
        public ?Carbon $graduation_date,
        #[OAT\Property]
        public string $phone_number,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public ?string $password,
        #[
            OAT\Property,
            Exists('temporary_uploaded_images', 'id')
        ]
        public ?int $temporary_profile_picture_id,
        #[
            ArrayProperty('integer'),
            WithCast(ArrayToCollectionCast::class),
            Present
        ]
        /** @var Collection<int> */
        public Collection $school_files_ids_to_add,
        #[
            ArrayProperty('integer'),
            WithCast(ArrayToCollectionCast::class),
            Present
        ]
        /** @var Collection<int> */
        public Collection $school_files_ids_to_delete,

        #[
            OAT\PathParameter(
                parameter: 'adminsUpdateStudentPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('users', 'id')
        ]
        public int $id,

    ) {}
}
