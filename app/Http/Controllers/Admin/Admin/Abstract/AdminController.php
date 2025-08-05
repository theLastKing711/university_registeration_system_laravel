<?php

namespace App\Http\Controllers\Admin\Admin\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/admins/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsCoursesUpdateCoursePathParameterData',
            ),
        ],
    ),
]
abstract class AdminController extends Controller {}
