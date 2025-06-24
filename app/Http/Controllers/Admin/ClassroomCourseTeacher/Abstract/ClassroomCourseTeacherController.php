<?php

namespace App\Http\Controllers\Admin\ClassroomCourseTeacher\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/classroom-course-teachers/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsUpdateCourseTeacherClassroomPathParameter',
            ),
        ],
    ),
]
abstract class ClassroomCourseTeacherController extends Controller {}
