<?php

namespace App\Http\Controllers\Admin\CourseTeacher\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/course-teachers/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsUpdateCourseTeacherRequestIdPathParameter',
            ),
        ],
    ),
]
abstract class CourseTeacherController extends Controller {}
