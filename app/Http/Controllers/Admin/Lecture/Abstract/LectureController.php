<?php

namespace App\Http\Controllers\Admin\Lecture\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/lectures/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsLectureUpdlateLectureREuqstDataIdPathParameter',
            ),
        ],
    ),
]
abstract class LectureController extends Controller {}
