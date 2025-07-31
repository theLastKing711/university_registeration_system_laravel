<?php

namespace App\Http\Controllers\Admin\Student\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/students/{id}/profile-picture/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsUpdateStudentPathParameter',
            ),
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsStudentDeleteStudentProfilePictureIdPathParameter',
            ),
        ],
    ),
]
abstract class StudentProfilePictureController extends Controller {}
