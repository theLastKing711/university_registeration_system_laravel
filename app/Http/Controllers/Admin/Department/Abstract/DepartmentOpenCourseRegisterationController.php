<?php

namespace App\Http\Controllers\Admin\Department\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/departments/{id}/open-course-registerations',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsDepartmentUpdateDepartmentIdPathParameter',
            ),
        ],
    ),
]
abstract class DepartmentOpenCourseRegisterationController extends Controller {}
