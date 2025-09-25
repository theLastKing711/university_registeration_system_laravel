<?php

namespace App\Data\Admin\AuditLog\OpenCourseRegisteration\CreateOpenCourseRegisterationAuditLog\Request;

use App\Data\Admin\OpenCourseRegisteration\CreateOpenCourseRegisteration\Request\CreateOpenCourseRegisterationRequestData;
use App\Data\Admin\OpenCourseRegisteration\CreateOpenCourseRegisteration\Request\CreateTeacherData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAuditLogOpenCourseRegisterationCreateOpenCourseRegisterationAuditLogRequestCreateOpenCourseRegisterationAuditLogRequestData')]
class CreateOpenCourseRegisterationAuditLogRequestData extends CreateOpenCourseRegisterationRequestData
{
    public function __construct(
        #[OAT\Property]
        public ?int $id,
        #[
            OAT\Property,
            Exists('courses', 'id')
        ]
        public int $course_id,
        #[OAT\Property]
        public int $academic_year_semester_id,
        #[OAT\Property]
        public int $price_in_usd,

        #[ArrayProperty(CreateTeacherData::class)]
        /** @var Collection<CreateTeacherData> */
        public Collection $teachers,
        #[OAT\Property]
        public string $resource,

        public string $action,

        #[OAT\Property]
        public ?CreateOpenCourseRegisterationRequestData $previousData

    ) {}
}
