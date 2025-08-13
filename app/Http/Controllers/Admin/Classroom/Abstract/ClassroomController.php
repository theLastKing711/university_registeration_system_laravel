<?php

namespace App\Http\Controllers\Admin\Classroom\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/classrooms/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsClassroomsUpdateCoursePathParameterData',
            ),
        ],
    ),
]
abstract class ClassroomController extends Controller {}
