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
class MeetingController extends Controller
{

    #[OAT\Get(path: '/admins/meetings', tags: ['adminsMeetings'])]
    public function __invoke()
    {

    }
}
