<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/open-course-registerations/{id}/teachers',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsOpenCourseRegisterationAssignTeachToCouresIdPathParameter',
            ),
        ],
    ),
]
abstract class OpenCourseRegisterationTeacherController extends Controller {}
