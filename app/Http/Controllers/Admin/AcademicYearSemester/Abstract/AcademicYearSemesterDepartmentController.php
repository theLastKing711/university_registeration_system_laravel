<?php

namespace App\Http\Controllers\Admin\AcademicYearSemester\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/academic-year-semesters/{id}/departments',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsAcademicYearSemesterOpenDepartmentsForRegisterationIdPathParameter',
            ),
        ],
    ),
]
abstract class AcademicYearSemesterDepartmentController extends Controller {}
