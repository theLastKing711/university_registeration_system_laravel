<?php

namespace App\Http\Controllers\Admin\Department\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/departments/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsUpdateCourseTeacherClassroomPathParameter',
            ),
        ],
    ),
]
abstract class DepartmentController extends Controller {}
