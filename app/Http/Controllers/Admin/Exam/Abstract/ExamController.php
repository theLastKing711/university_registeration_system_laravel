<?php

namespace App\Http\Controllers\Admin\Exam\Abstract;

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
abstract class ExamController extends Controller {}
