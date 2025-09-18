<?php

namespace App\Http\Controllers\Admin\Meeting\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/meetings/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/testIdPathParameter',
            ),
        ],
    ),
]
abstract class MeetingController extends Controller {}
