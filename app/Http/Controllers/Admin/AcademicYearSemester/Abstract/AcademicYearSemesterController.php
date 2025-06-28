<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/academic-year-semesters/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsUpdateCourseTeacherRequestIdPathParameter',
            ),
        ],
    ),
]
abstract class AcademicYearSemesterController extends Controller {}
