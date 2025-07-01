<?php

namespace App\Http\Controllers\Admin\Course\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/courses/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsCoursesUpdateCoursePathParameterData',
            ),
        ],
    ),
]
abstract class CourseController extends Controller {}
