<?php

namespace App\Http\Controllers\Admin\Exam\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/exams/{id}/students',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsExamASsignMarkToStudentIdPathParameter',
            ),
        ],
    ),
]
abstract class ExamStudentCotnroller extends Controller {}
