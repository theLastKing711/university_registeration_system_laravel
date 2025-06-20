<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/course-registerations/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminOpenCourseRegisterationPathParameter',
            ),
        ],
    ),
]
abstract class OpenCourseRegisterationController extends Controller {}
