<?php

namespace App\Http\Controllers\Admin\Teacher\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/teachers/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsTeacherPathParameter',
            ),
        ],
    ),
]
abstract class TeacherController extends Controller {}
