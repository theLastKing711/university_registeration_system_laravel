<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/exams/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsDeleteExamPathParameter',
            ),
        ],
    ),
]
class ExamController extends Controller {}
