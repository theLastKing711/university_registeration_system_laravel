<?php

namespace App\Data\Admin\Student\Response;

use App\Data\Shared\Casts\MediallyToSingleMediaCast;
use App\Data\Shared\Media\SingleMedia;
use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\User;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminStudentResponseGetStudentResponseData')]
class GetStudentResponseData extends Data
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
        #[
            OAT\Property,
        ]
        public ?SingleMedia $profile_picture,
    ) {}

    // WithCast(MediallyToSingleMediaCast::class),

    public static function fromModel(User $user): self
    {
        return new self(
            $user->department_id,
            $user->national_id,
            $user->birthdate,
            $user->enrollment_date,
            $user->graduation_date,
            $user->phone_number,
            $user->name,
            SingleMedia::from($user)
        );
    }
}
