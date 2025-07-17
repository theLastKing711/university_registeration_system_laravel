<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/students/open-course-registerations/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsTeacherPathParameter',
            ),
        ],
    ),
]
abstract class OpenCourseRegisterationController extends Controller {}
