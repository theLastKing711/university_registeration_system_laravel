<?php

namespace App\Data\Admin\Course\GetCourse\Response;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\Course;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseGetCourseResponseGetCourseResponseData')]
class GetCourseResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
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
        #[ArrayProperty(CrossListedItemData::class)]
        /** @var Collection<CrossListedItemData> */
        public Collection $cross_listed_courses,
        #[ArrayProperty(PrerequisiteItemData::class)]
        /** @var Collection<PrerequisiteItemData> */
        public Collection $prerequisites,
    ) {}

    public static function fromModel(Course $course): self
    {

        $cross_listed_courses =
            $course
                ->firstCrossListed
                ->merge(
                    $course
                        ->SecondCrossListed
                );

        return new self(
            $course->id,
            $course->department_id,
            $course->name,
            $course->code,
            $course->is_active,
            $course->credits,
            $course->open_for_students_in_year,
            CrossListedItemData::collect($cross_listed_courses),
            PrerequisiteItemData::collect(
                $course->coursesPrerequisites
            )
        );
    }
}
