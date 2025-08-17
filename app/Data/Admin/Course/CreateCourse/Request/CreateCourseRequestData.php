<?php

namespace App\Data\Admin\Course\CreateCourse\Request;

use App\Data\Shared\IdData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class CreateCourseRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $department_id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $code,
        #[OAT\Property]
        public bool $is_active,
        #[OAT\Property]
        public int $credits,
        #[OAT\Property]
        public int $open_for_students_in_year,

        #[
            ArrayProperty(IdData::class),
        ]
        /** @var Collection<IdData> */
        public Collection $cross_listed_courses,

        #[
            ArrayProperty(IdData::class),
        ]
        /** @var Collection<IdData> */
        public Collection $prerequisites,

        #[ArrayProperty(IdData::class)]
        /** @var Collection<CreateTeacherData> */
        public Collection $teachers,

    ) {}
}
