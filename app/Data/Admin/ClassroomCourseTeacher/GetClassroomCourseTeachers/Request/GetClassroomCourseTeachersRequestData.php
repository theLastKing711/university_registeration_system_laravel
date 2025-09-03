<?php

namespace App\Data\Admin\ClassroomCourseTeacher\GetClassroomCourseTeachers\Request;

use App\Data\Shared\Pagination\QueryParameters\PaginationQueryParameterData;
use OpenApi\Attributes as OAT;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminClassroomCourseTeacherGetClassroomCourseTeachersRequestGetClassroomCourseTeachersRequestData')]
class GetClassroomCourseTeachersRequestData extends PaginationQueryParameterData
{
    public function __construct(

        ?int $page,
        ?int $perPage,

        #[OAT\Property]
        public ?int $department_id,
        #[OAT\Property]
        public ?int $academic_year_semester_id,
    ) {
        parent::__construct($page, $perPage);

    }
}
