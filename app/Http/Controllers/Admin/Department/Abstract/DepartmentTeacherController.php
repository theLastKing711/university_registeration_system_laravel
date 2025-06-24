<?php

namespace App\Http\Controllers\Admin\Department\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/departments/{id}/teachers',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsGetDepartmentTeachersPathParameter',
            ),
        ],
    ),
]
abstract class DepartmentTeacherController extends Controller {}
