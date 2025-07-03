<?php

namespace App\Http\Controllers\Admin\CourseTeacher\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/course-teachers/{id}/exams',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsCourseTeachersGetCourseTeachersLecturesIdPathParameter',
            ),
        ],
    ),
]
abstract class CourseTeacherExamController extends Controller {}
